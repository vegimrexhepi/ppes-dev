<?php

namespace ppes\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ppes\Http\Requests;
use ppes\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }

    public function dashboard(Request $request)
    {

        if (! $request->user()->isLecturer()) {
            //return view('student.index', ['user' => $request->user()]);
            return redirect()->route('student.index');
        } else {
            //return view('lecturer.index', ['user' => $request->user()]);
            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $request->user()->id
            ]);
        }
    }
}
