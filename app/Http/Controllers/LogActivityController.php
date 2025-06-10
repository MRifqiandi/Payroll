<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;

class LogActivityController extends Controller
{
    public function index()
    {
        // Ambil data log terbaru, 20 per halaman
        $logs = LogActivity::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('pages.log_activity.index', compact('logs'));
    }
}
