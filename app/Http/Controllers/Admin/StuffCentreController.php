<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StuffCentre;
use App\Http\Requests\StuffCentreRequest;

class StuffCentreController extends Controller
{
    public function index()
    {
        $stuff = StuffCentre::all();

        return view('admin.stuffcentre.index', compact('stuff'));
    }

    public function add(){

        return view('admin.stuffcentre.create');
    }

    public function create(StuffCentreRequest $request)
    {
        $stuff = StuffCentre::create([
           'name' => $request->name,
           'position' => $request->position
        ]);
        $stuff->save();
        return redirect()->route('admin_stuff_centre')->with('success', 'Успешно добавлен');
    }
    public function show($id)
    {
        $stuff = StuffCentre::find($id);

        return view('admin.stuffcentre.show', compact('stuff'));
    }

    public function update($id, StuffCentreRequest $request)
    {
        $stuff = StuffCentre::find($id);

        $stuff->name = $request->name;
        $stuff->position = $request->position;

        $stuff->save();

        return redirect()->route('admin_stuff_centre')->with('success', 'Успешно обновлен');
    }
    public function delete($id)
    {
        $stuff = StuffCentre::find($id);
        $stuff->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
