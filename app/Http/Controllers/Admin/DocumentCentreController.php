<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCentre;
use PhpParser\Comment\Doc;
use App\Http\Requests\DocumentCentreRequest;
class DocumentCentreController extends Controller
{
    public function index()
    {
        $document = DocumentCentre::all();
        return view('admin.document.index', compact('document'));
    }

    public function add()
    {
        return view('admin.document.create');
    }

    public function create(DocumentCentreRequest $request)
    {
        $request->validated();

        $document = DocumentCentre::create([
            'name' => $request->name,
            'fignyashka' => $request->fignyashka,
            'description' => $request->description,
            'type' => $request->type,

        ]);

        $document->save();

        return redirect()->route('admin_document_centre')->with('success', 'Успешно добавлен');
    }

    public function edit($id)
    {
        $document = DocumentCentre::find($id);

        return view('admin.document.show', compact('document'));
    }

    public function update(DocumentCentreRequest $request, $id)
    {
        $document = DocumentCentre::find($id);

        $document->name = $request->name;
        $document->fignyashka = $request->fignyashka;
        $document->description = $request->description;
        $document->type = $request->type;

        $document->update();

        return redirect()->route('admin_document_centre')->with('success', 'Успешно изменен');
    }

    public function delete($id)
    {
        $document = DocumentCentre::find($id);

        $document->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
