<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogRequest;
use Illuminate\Http\Request;
use App\Models\ManagementCentre;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ManagementCentreRequest;

class ManagementCentreController extends Controller
{
    public function index()
    {
        $management = ManagementCentre::all();
        return view('admin.management.index', compact('management'));
    }

    public function add()
    {
        return view('admin.management.create');
    }

    public function create(ManagementCentreRequest $request)
    {
        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);

        $management = ManagementCentre::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $image,
            'description' => $request->description,
            'phone' => $request->phone,
            'tg_link' => $request->tg_link,
            'insta_link' => $request->insta_link,
            'fb_link' => $request->fb_link,
            'email' => $request->email,
        ]);

        $management->save();

        return redirect()->route('admin_management')->with('success', 'Успешно добавлен');
    }

    public function edit($id)
    {
        $management = ManagementCentre::find($id);

        return view('admin.management.show', compact('management'));
    }

    public function update($id, CatalogRequest $request)
    {
        $management = ManagementCentre::find($id);

        if ($request->hasFile('image')){
            $destination = public_path('images/').$management->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $management->image = $image;
        }
        $management->name = $request->name;
        $management->position = $request->position;
        $management->description = $request->description;
        $management->phone = $request->phone;
        $management->tg_link = $request->tg_link;
        $management->insta_link = $request->insta_link;
        $management->fb_link = $request->fb_link;
        $management->email = $request->email;

        $management->update();

        return redirect()->route('admin_management')->with('success' , 'Успешно обновлен');

    }

    public function delete($id)
    {
        $management = ManagementCentre::find($id);

        $destination = public_path('images/').$management->image;
        if(File::exists($destination)){
            File::delete($destination);
        }

        $management->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }

}
