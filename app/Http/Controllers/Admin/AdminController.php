<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(){

        if(!Auth::check()){

            return redirect()->route('admin.login');
        }
        else{
            return view('admin.index');
        }


    }

}
