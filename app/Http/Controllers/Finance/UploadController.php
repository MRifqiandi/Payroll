<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\UserUpload;
use App\Services\UploadService;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index()
    {
        return view('pages.upload.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        $file = $request->file('file');

        $fileData = UploadService::parseFileData($file);

        $userKeys = UploadService::fetchUserKeysByEmail(array_keys($fileData));

        $encryptedSlips = UploadService::createEncryptedSlips($userKeys['data'], $fileData, $file->getClientOriginalName());

        DB::beginTransaction();

        UploadService::store(Auth::user(), $request->file('file'), $encryptedSlips);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully.',
        ]);
    }
}
