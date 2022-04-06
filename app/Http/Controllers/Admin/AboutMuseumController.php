<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutMuseum;
use App\Http\Requests\AboutMuseumRequest;
use Illuminate\Support\Facades\File;

class AboutMuseumController extends Controller
{
    public function index()
    {
        $museum = AboutMuseum::all();

        return view('admin.about_museum.index', compact('museum'));
    }

    public function add()
    {
        return view('admin.about_museum.create');
    }

    public function create(AboutMuseumRequest $request)
    {
        $request->validated();

        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);

        $museum = AboutMuseum::create([
           'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ]);

        $museum->save();

        return redirect()->route('admin_about_museums')->with('success', 'Запись успешно создан');
    }

    public function edit($id)
    {
        $museum = AboutMuseum::find($id);

        return view('admin.about_museum.show', compact('museum'));
    }

    public function update(AboutMuseumRequest $request, $id)
    {
        $museum = AboutMuseum::find($id);

        if ($request->hasFile('image')){
            $destination = public_path('images/').$museum->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $museum->image = $image;
        }
        $museum->name = $request->name;
        $museum->description = $request->description;

        $museum->update();

        return redirect()->route('admin_about_museums')->with('success', 'Успешно обновлен');

    }

    public function delete($id)
    {
        $museum = AboutMuseum::find($id);

        $destination = public_path('images/').$museum->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $museum->delete();

        return redirect()->back()->with('success', 'Успешно удален');

    }
}
