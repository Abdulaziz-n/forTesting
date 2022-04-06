<?php

namespace App\Http\Controllers;

use http\Env\Url;
use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'DESC')->take(6)->get();

        return view('pages.main.index', compact('news'));
    }


}
