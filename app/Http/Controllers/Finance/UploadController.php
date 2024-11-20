<?php

namespace App\Http\Controllers\Finance;

use App\Exports\UploadExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserUpload;
use App\Services\UploadService;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class UploadController extends Controller
{
    public function index()
    {
        return view('pages.upload.index');
    }

    public function download($id)
    {
        $upload = UserUpload::whereId($id)->first();

        if (!$upload) {
            throw new HttpException(404, 'File not found');
        }

        $data = Utils::DECRYPT_SLIP(
            $upload->file,
            $upload->key,
            $upload->iv,
            $upload->user->private_key
        );

        return Excel::download(new UploadExport($data), $upload->name . ".xlsx");
    }

    public function getReceivers(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $upload = UserUpload::whereId($request->id)->first();

        if (!$upload) {
            throw new HttpException(404, 'File not found');
        }

        $receivers = User::select([
            'name',
            'email'
        ])->whereIn('id', $upload->files()->pluck('user_id'))
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $receivers,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:csv,xlsx,xls',
            'accept' => 'nullable',
        ]);

        $file = $request->file('file');

        $fileData = UploadService::parseFileData($file);

        $userKeys = UploadService::fetchUserKeysByNumber(array_keys($fileData));

        $encryptedSlips = UploadService::createEncryptedSlips($userKeys['data'], $fileData, $request->name);

        if (count($userKeys['invalid']) > 0 && !$request->accept) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Some NIP/NIPPPK/NIPH were not found in the database. Do you want to continue?',
                'data' => $userKeys['invalid'],
            ]);
        }

        DB::beginTransaction();

        UploadService::store(Auth::user(), $file, $encryptedSlips, $request->name);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully.',
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $upload = UserUpload::whereId($request->id)->first();

        if (!$upload) {
            throw new HttpException(404, 'File not found');
        }

        $upload->files()->delete();
        $upload->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'File deleted successfully.',
        ]);
    }

    public function getDatatable()
    {
        $query = UserUpload::with('user')
            ->select(['id', 'name', 'user_id', 'created_at'])
            ->withCount('files')
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return view('pages.upload.menu', compact('query'));
            })
            ->addColumn('user', function ($query) {
                return $query->user->name;
            })
            ->addColumn('receivers', function ($query) {
                return view('pages.upload.receiver', compact('query'));
            })
            ->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('d F Y H:i:s');
            })
            ->rawColumns(['action', 'receivers'])
            ->make(true);
    }
}
