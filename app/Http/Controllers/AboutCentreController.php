<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationCentre;
class AboutCentreController extends Controller
{
    public function index()
    {
        $centre = OrganizationCentre::all();
        return view('pages.aboutCentre.main', compact('centre'));
    }
//    public function main()
//    {
//        return view('pages.aboutCentre.main');
//    }
}
