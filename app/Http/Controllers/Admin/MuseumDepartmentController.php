<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MuseumDepartment;
use App\Http\Requests\MuseumDepartmentRequest;
use Illuminate\Support\Facades\File;

class MuseumDepartmentController extends Controller
{
    public function index()
    {
        $museum = MuseumDepartment::all();

        return view('admin.museum_department.index', compact('museum'));
    }
    public function create()
    {
        return view('admin.museum_department.create');
    }

    public function store(MuseumDepartmentRequest $request)
    {
        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);

        $department = MuseumDepartment::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
        ]);
        $department->save();

        return redirect()->route('admin_museum_department')->with('success' , 'Успешно создан');
    }
    public function edit($id)
    {
        $department = MuseumDepartment::find($id);

        return view('admin.museum_department.show', compact('department'));
    }

    public function update($id, MuseumDepartmentRequest $request)
    {
        $department = MuseumDepartment::find($id);

        $department->title = $request->title;
        $department->description = $request->description;

        if ($request->hasFile('image')){
            $destination = public_path('images/').$department->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $department->image = $image;
        }

            $department->update();

        return redirect()->route('admin_museum_department')->with('success', 'Успешно обновлен');
    }

    public function delete($id)
    {
        $department = MuseumDepartment::find($id);

            $destination = public_path('images/').$department->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $department->delete();

            return redirect()->back()->with('success', 'Успешно удален');
    }
}
