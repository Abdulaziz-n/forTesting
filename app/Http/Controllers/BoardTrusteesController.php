<?php

namespace App\Http\Controllers;

use App\Models\StuffCentre;
use Illuminate\Http\Request;
use App\Models\BoardTrustees;
class BoardTrusteesController extends Controller
{
    public function index()
    {
        $data = BoardTrustees::all();

        return view('pages.boardTrustees.index', compact('data'));
    }
}
