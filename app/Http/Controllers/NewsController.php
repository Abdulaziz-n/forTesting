<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('pages.news.index',compact('news'));
    }
    public function newsItem()
    {
        return view('pages.news.news-item');
    }
}
