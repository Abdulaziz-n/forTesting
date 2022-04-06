<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagementCentre;

class ManagementController extends Controller
{
    public function getManagement()
    {
        $management = ManagementCentre::all();

        return view('pages.management.index', compact('management'));
    }

    public function detail($id)
    {
        $management = ManagementCentre::find($id);

        return view('pages.management.detail', compact('management'));
    }
}
