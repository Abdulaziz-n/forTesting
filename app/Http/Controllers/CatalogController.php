<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalog = Catalog::orderBy('created_at', 'DESC')->get();

        return view('pages.catalog.index', compact('catalog'));
    }
}
