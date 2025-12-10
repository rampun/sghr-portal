<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        // dump($request->get('title'));
        return view('pages.jobs.index');
    }
    public function show(Request $request)
    {
        // dump($request->get('title'));
        return view('pages.jobs.single');
    }
}
