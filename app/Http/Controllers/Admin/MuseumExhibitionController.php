<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuseumExhibition;
use App\Http\Requests\MuseumExhibitionRequest;
use Illuminate\Support\Facades\File;


class MuseumExhibitionController extends Controller
{
    public function index()
    {
        $museum = MuseumExhibition::all();

        return view('admin.museum_exhibitions.index', compact('museum'));
    }
    public function create()
    {
        return view('admin.museum_exhibitions.create');
    }

    public function store(MuseumExhibitionRequest $request)
    {
        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);

        $exhibitions = MuseumExhibition::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ]);
        $exhibitions->save();

        return redirect()->route('admin_museum_exhibition')->with('success' , 'Успешно создан');
    }
    public function edit($id)
    {
        $exhibitions = MuseumExhibition::find($id);

        return view('admin.museum_exhibitions.show', compact('exhibitions'));
    }

    public function update($id, MuseumExhibitionRequest $request)
    {
        $exhibitions = MuseumExhibition::find($id);

        $exhibitions->title = $request->title;
        $exhibitions->description = $request->description;

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

        return redirect()->route('admin_museum_exhibition')->with('success', 'Успешно обновлен');
    }

    public function delete($id)
    {
        $exhibitions = MuseumExhibition::find($id);

        $destination = public_path('images/').$exhibitions->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $exhibitions->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
