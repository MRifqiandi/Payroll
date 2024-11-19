<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        return view('pages.api-key.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required|array'
        ]);

        //
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
    }

    public function getDatatable()
    {
        //
    }
}
