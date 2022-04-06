<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CorruptionRequest;
use Illuminate\Http\Request;
use App\Models\Corrupsion;
class CorruptionController extends Controller
{
    public function index()
    {
        $corruption = Corrupsion::all();

        return view('admin.corruption.index', compact('corruption'));
    }

    public function create()
    {

        return view('admin.corruption.create');
    }

    public function store(CorruptionRequest $request)
    {

        $corruption = Corrupsion::create([
            'title' => $request->title,
            'law' => $request->law,
            'description' => $request->description,
            'type' => $request->type,

        ]);

        $corruption->save();

        return redirect()->route('admin_corruption')->with('success', 'Успешно добавлен');
    }

    public function edit($id)
    {
        $corruption = Corrupsion::find($id);

        return view('admin.corruption.show', compact('corruption'));
    }

    public function update($id, Request $request)
    {
        $corruption = Corrupsion::find($id);

        $corruption->title = $request->title;
        $corruption->description = $request->description;
        $corruption->law = $request->law;
        $corruption->type = $request->type;

        $corruption->update();

        return redirect()->route('admin_corruption')->with('message', 'Успешно обновлен');
    }

    public function delete($id)
    {
         $corruption = Corrupsion::find($id);

         $corruption->delete();

         return redirect()->back()->with('success', 'Успешно удален');
    }
}
