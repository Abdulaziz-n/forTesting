<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CvRequest;
use Illuminate\Http\Request;
use App\Models\CV;
class CvAdminController extends Controller
{
    public function index()
    {
        $cv = CV::orderBy('created_at', 'DESC')->get();

        return view('admin.vacancies.index', compact('cv'));
    }

    public function store(CvRequest $request)
    {
        $file = time() . '-'. $request->name . '.' . $request->file->extension();
        $request->file->move(public_path('files'), $file);

        $cv = CV::create([
           'position' => $request->position,
           'name' => $request->name,
           'date_of_birth' => $request->date_of_birth,
           'nationality' => $request->nationality,
           'marital_status' => $request->marital_status,
            'city' => $request->city,
            'district' => $request->district,
            'street' => $request->street,
            'phone' => $request->phone,
            'email' => $request->email,
            'stir' => $request->stir,
            'education' => $request->education,
            'speciality' => $request->speciality,
            'education_place' => $request->education_place,
            'date_finished' => $request->date_finished,
            'enter_happy' => $request->enter_happy,
            'additional_information' => $request->additional_information,
            'file' => $file
        ]);

        $cv->save();

        return redirect()->back()->with('message','Успешно отправлен');
    }

    public function edit($id)
    {
        $cv = CV::find($id);

        return view('admin.vacancies.show', compact('cv'));
    }

    public function changeStatus($id, Request $request)
    {
        $cv = CV::find($id);

        $cv->status = $request->status;

        $cv->update();

        return redirect()->route('vacancies_admin')->with('message', 'Статус успешно обновлен');
    }
}
