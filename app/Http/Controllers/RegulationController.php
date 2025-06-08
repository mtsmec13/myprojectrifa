<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\Request;

class RegulationController extends Controller
{
    public function index()
    {
        return view('regulation');
    }
}
