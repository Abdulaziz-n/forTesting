<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Corrupsion;
use Illuminate\Http\Request;

class CorruptionController extends Controller
{
    public function index()
    {
        $corruption = Corrupsion::orderBy('created_at', 'DESC')->get();

        return view('pages.corruption.index', compact('corruption'));
    }

    public function detail($id)
    {
        $corruption = Corrupsion::find($id);

        return view('pages.corruption.detail', compact('corruption'));
    }
}
