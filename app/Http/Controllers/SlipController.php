<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\UserFile;
use App\Utils;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class SlipController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }

    public function download($id)
    {
        if (Auth::user()['2fa_secret']) {
            if (!Utils::IS_DEVICE_VALIDATED()) {
                return redirect()->route('slip.index')->with('error', 'OTP not validated');
            }
        }

        $file = UserFile::whereId($id)->first();

        if (!$file) {
            throw new HttpException(404, 'File not found');
        }

        if ($file->user_id !== auth()->id()) {
            throw new HttpException(403, 'Unauthorized');
        }

        $data = Utils::DECRYPT_SLIP(
            $file->file,
            $file->key,
            $file->iv,
            Auth::user()->private_key
        );

        $user = [
            'name' => auth()->user()->name,
            'nip' => auth()->user()->nip,
            'rank' => auth()->user()->rank,
            'position' => auth()->user()->position,
        ];

        switch ($file->type) {
            case Constants::SLIP_TYPE['GAJI BULANAN']:
                $pdf = Pdf::loadView('exports.slip.monthly-salary', [
                    'user' => $user,
                    'data' => $data,
                ]);
                break;
            case Constants::SLIP_TYPE['UANG MAKAN']:
                throw new HttpException(400, 'Not Implemented');
                break;
            default:
                throw new HttpException(404, 'File not found');
        }

        return $pdf->download($file->name . ' slip-gaji-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }

    public function getDatatable()
    {
        $query = UserFile::where('user_id', Auth::user()->id)
            ->with('upload.user:id,name')
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                return view('pages.home.menu', compact('query'));
            })
            ->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('d F Y H:i:s');
            })
            ->addColumn('user', function ($query) {
                return $query->upload->user->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
