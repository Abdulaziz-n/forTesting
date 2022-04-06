<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogRequest;
use App\Models\ManagementCentre;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Http\Request;
use App\Models\Catalog;
use Illuminate\Support\Facades\File;

class CatalogController extends Controller
{
    public function index()
    {
        $catalog = Catalog::orderBy('created_at', 'DESC')->get();

        return view('admin.catalog.index', compact('catalog'));
    }

    public function create()
    {
        return view('admin.catalog.create');
    }

    public function store(CatalogRequest $request)
    {
//        $file = uniqid().'-'.$request->title.'.'.$request->file->extension();
//        $request->file->move(public_path('files'),$file);
        $file = $request->file('file')->store('files');

//        $image = uniqid() . '-'. $request->title . '.' . $request->image->extension();
//        $request->image->move(public_path('images'), $image);
        $image = $request->file('file')->store('images');


        Catalog::query()->create([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'type' => $request->type,
            'file' => $file,
            'image' => $image,
        ]);


        return redirect()->route('admin_catalog')->with('success', 'Успешно создан');
    }

    public function edit($id)
    {
        $catalog = Catalog::find($id);

        return view('admin.catalog.show', compact('catalog'));
    }

    public function update($id, Request $request)
    {
        $catalog = Catalog::find($id);

        if ($request->hasFile('image')){
            $destination = public_path('images/').$catalog->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = uniqid() . '-'. $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $catalog->image = $image;
        }
        if ($request->hasFile('file')){
            $destination = public_path('files/').$catalog->file;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = uniqid() . '-'. $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $catalog->image = $image;
        }

//        $catalog->title = $request->title;
//        $catalog->author = $request->author;
//        $catalog->price = $request->price;
//        $catalog->type = $request->type;

        $catalog->update([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'type' => $request->type,
        ]);


        return redirect()->route('admin_catalog')->with('success', 'Успешно обновлен');


    }

    public function delete($id)
    {
        $catalog = Catalog::find($id);

        $destination = public_path('images/').$catalog->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $catalog->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
