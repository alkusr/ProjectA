<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTestController extends Controller
{
    //index
    public function index()
    {
        // dd($test);
        return view('admin.test.index');
    }
}
