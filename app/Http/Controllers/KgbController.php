<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class KgbController extends Controller
{


public function updatePrediksiManual(Request $request)
{
    Artisan::call('kgb:update-prediksi');
    $output = trim(Artisan::output());

    return response()->json([
        'message' => $output
    ]);
}

}
