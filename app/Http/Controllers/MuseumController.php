<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuseumController extends Controller
{
    public function index()
    {
        return view('pages.museum.index');
    }
    public function exponats()
    {
        return view('pages.museum.exponats');
    }
    public function departments()
    {
        return view('pages.museum.departments');
    }
    public function visit()
    {
        return view('pages.museum.visit');
    }
    public function staff()
    {
        return view('pages.museum.staff');
    }
    public function exhibitions()
    {
        return view('pages.museum.exhibitions');
    }
}
