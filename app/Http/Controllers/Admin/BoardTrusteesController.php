<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardTrustessRequest;
use Illuminate\Http\Request;
use App\Models\BoardTrustees;
class BoardTrusteesController extends Controller
{
    public function index()
    {
        $stuff = BoardTrustees::all();

        return view('admin.boardTrustees.index', compact('stuff'));
    }

    public function add(){

        return view('admin.boardTrustees.create');
    }

    public function create(BoardTrustessRequest $request)
    {
        $stuff = BoardTrustees::create([
            'name' => $request->name,
            'position' => $request->position
        ]);
        $stuff->save();
        return redirect()->route('admin_board_trustees')->with('success', 'Успешно добавлен');
    }
    public function show($id)
    {
        $stuff = BoardTrustees::find($id);

        return view('admin.boardTrustees.show', compact('stuff'));
    }

    public function update($id, BoardTrustessRequest $request)
    {
        $stuff = BoardTrustees::find($id);

        $stuff->name = $request->name;
        $stuff->position = $request->position;

        $stuff->save();

        return redirect()->route('admin_board_trustees_centre')->with('success', 'Успешно обновлен');
    }
    public function delete($id)
    {
        $stuff = BoardTrustees::find($id);
        $stuff->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
