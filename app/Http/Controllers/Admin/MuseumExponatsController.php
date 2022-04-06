<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuseumExponats;
use App\Http\Requests\MuseumExponatsRequest;
use Illuminate\Support\Facades\File;

class MuseumExponatsController extends Controller
{

    public function index()
    {
        $museum = MuseumExponats::all();

        return view('admin.museum_exponats.index', compact('museum'));
    }

    public function create()
    {
        return view('admin.museum_exponats.create');
    }

    public function store(MuseumExponatsRequest $request)
    {
        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);

        $exhibitions = MuseumExponats::create([
            'title' => $request->title,
            'description' => $request->description,
            'date_exp' => $request->date_exp,
            'image' => $image,
        ]);
        $exhibitions->save();

        return redirect()->route('admin_museum_exponats')->with('success' , 'Успешно создан');
    }
    public function edit($id)
    {
        $exhibitions = MuseumExponats::find($id);

        return view('admin.museum_exponats.show', compact('exhibitions'));
    }

    public function update($id, MuseumExponatsRequest $request)
    {
        $exhibitions = MuseumExponats::find($id);

        $exhibitions->title = $request->title;
        $exhibitions->description = $request->description;
        $exhibitions->date_exp = $request->date_exp;


        if ($request->hasFile('image')){
            $destination = public_path('images/').$exhibitions->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $exhibitions->image = $image;
        }

        $exhibitions->update();

        return redirect()->route('admin_museum_exponats')->with('success', 'Успешно обновлен');
    }

    public function delete($id)
    {
        $exhibitions = MuseumExponats::find($id);

        $destination = public_path('images/').$exhibitions->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $exhibitions->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }

}
