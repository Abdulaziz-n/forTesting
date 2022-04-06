<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskCentre;

class CentreTasksController extends Controller
{
    public function index()
    {
        $tasks = TaskCentre::all();

        return view('pages.tasksCentre.index', compact('tasks'));
    }


}
