<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StuffCentre;
class StaffCentreController extends Controller
{
    public function index()
    {
       $staff = StuffCentre::all();

       return view('pages.staffCentre.index', compact('staff'));
    }
}
