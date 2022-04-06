<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AdminNewsRequest;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        return view('admin.news.index', compact('news'));
    }

    public function createNews(){

        return view('admin.news.create_news');
    }

    public function create(AdminNewsRequest $request)
    {

        $image = time() . '-'. $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $image);


        $news = News::create([
            "name" => $request->name,
            "description" => $request->description,
            "image" => $image
        ]);
        $news->save();
        return redirect()->route('admin_news')->with('success', 'Новость успешно добавлена');
    }
    public function update($id){

        $news = News::where('id', $id)->first();

        return view('admin.news.show', compact('news'));
    }

    public function edit(AdminNewsRequest $request, $id)
    {
        $news = News::where('id', $id)->first();

        $news->name = $request->name;
        $news->description = $request->description;

        if ($request->hasFile('image')){
            $destination = public_path('images/').$news->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image = time() . '-'. $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            $news->image = $image;
        }

        $news->update();
        return redirect()->back()->with('success' , 'Успешно обновлен');
    }
    public function delete($id)
    {
        $news = News::find($id);
        $destination = public_path('images/').$news->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $news->delete();

        return redirect()->back()->with('success', 'Успешно удален');
    }
}
