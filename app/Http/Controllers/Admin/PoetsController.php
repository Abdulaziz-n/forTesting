<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poet;
class PoetsController extends Controller
{
    public function index()
    {
       $poet = Poet::orderBy('created_at', 'DESC');

       return view('admin.poets.index', compact('poet'));
    }


}
