<?php

namespace App\Http\Controllers;

use App\Models\UserFile;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Yajra\DataTables\Facades\DataTables;

class SlipController extends Controller
{
    public function index()
    {
        // $data = [
        //     'nama' => 'Dwi Harti Ningrum',
        //     'nip' => '199609112022032020',
        //     'pangkat' => 'III/a',
        //     'jabatan' => 'Staf Administrasi',
        //     'gaji_pokok' => '3.571.000',
        //     'tunjangan_istri_suami' => '357.100',
        //     'tunjangan_anak' => '71.420',
        //     'tunjangan_umum' => '-',
        //     'tunjangan_beras' => '217.260',
        //     'tunjangan_pajak' => '-',
        //     'penghasilan_kotor' => '4.216.870',
        //     'iwp' => '319.961',
        //     'pot_bpjs' => '73.209',
        //     'jumlah_potongan' => '393.170',
        //     'penghasilan_bersih' => '3.823.700',
        //     'tanggal' => '4 November 2024',
        //     'nama_pembuat' => 'Dwi Harti Ningrum',
        //     'nip_pembuat' => '199609112022032020',
        // ];

        // return view('exports.slip.gaji-bulanan', compact('data'));
        return view('pages.home.index');
    }

    public function download($id)
    {
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

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
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
