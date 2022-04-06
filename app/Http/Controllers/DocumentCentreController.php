<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCentre;
class DocumentCentreController extends Controller
{
    public function index()
    {
       $document = DocumentCentre::all();

       return view('pages.documentCentre.index', compact('document'));
    }

    public function detail($id)
    {
        $document = DocumentCentre::find($id);

        return view('pages.documentCentre.detail', compact('document'));
    }
}
