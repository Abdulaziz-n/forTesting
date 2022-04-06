<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VirtualTourController extends Controller
{
    public function index()
    {
        return view('pages.virtualTour.index');
    }
}
