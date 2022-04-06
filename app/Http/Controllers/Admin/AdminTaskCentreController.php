<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskCentre;
use App\Http\Requests\TaskCentreRequest;


class AdminTaskCentreController extends Controller
{
    public function show()
    {
        $tasks = TaskCentre::all();

        return view('admin.tasks.show', compact('tasks'));
    }

    public function update($id, TaskCentreRequest $request)
    {
        $tasks = TaskCentre::find($id);

        $tasks->title = $request->title;
        $tasks->description = $request->description;

        $tasks->update();
        return redirect()->back()->with('success', 'Успешно изменен');
    }
}
