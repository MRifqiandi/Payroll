<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Tax;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
public function index()
{
    $taxes = Tax::with('employee', 'ptkp')->latest()->paginate(10);
    return view('pages.payroll.tax-detail', compact('taxes'));
}
}
