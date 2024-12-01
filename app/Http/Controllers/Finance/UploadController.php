<?php

namespace App\Http\Controllers\Finance;

use App\Constants;
use App\Exports\Upload\MealAllowance;
use App\Exports\Upload\MonthlySalary;
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
        if (Auth::user()['2fa_secret']) {
            if (!Utils::IS_DEVICE_VALIDATED()) {
                return redirect()->route('upload.index')->with('error', 'OTP not validated');
            }
        }

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

        switch ($upload->type) {
            case Constants::SLIP_TYPE['GAJI BULANAN']:
                return Excel::download(new MonthlySalary($data), $upload->name . ".xlsx");
            case Constants::SLIP_TYPE['UANG MAKAN']:
                return Excel::download(new MealAllowance($data), $upload->name . ".xlsx");
            default:
                throw new HttpException(404, 'Invalid slip type');
        }
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
            'email',
            'number'
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
            'type' => 'required|in:' . implode(',', array_keys(Constants::SLIP_TYPE)),
            'accept' => 'nullable',
        ]);

        $file = $request->file('file');

        $fileData = UploadService::parseFileData($file, $request->type);

        $userKeys = UploadService::fetchUserKeysByNumber(array_keys($fileData));

        if (count($userKeys['invalid']) > 0 && !$request->accept) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Some NIP/NIPPPK/NIPH were not found in the database. Do you want to continue?',
                'data' => [...$userKeys['invalid']],
            ]);
        }

        $encryptedSlips = UploadService::createEncryptedSlips($userKeys['data'], $fileData, $request->name, $request->type);

        DB::beginTransaction();

        UploadService::store(Auth::user(), $file, $encryptedSlips, $request->name, $request->type);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully.',
        ]);
    }

    public function delete(Request $request)
    {
        if (Auth::user()['2fa_secret']) {
            if (!Utils::IS_DEVICE_VALIDATED()) {
                return redirect()->route('upload.index')->with('error', 'OTP not validated');
            }
        }

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
            ->select(['id', 'name', 'type', 'user_id', 'created_at'])
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
