<?php

namespace ppes\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use ppes\Http\Requests;
use ppes\Http\Controllers\Controller;
use ppes\Models\User;
use Hash;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('lecturer.index', ['user' => $request->user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $flashAlert = $request->session()->get('flash_alert', null);
        $user = User::findOrFail($id);
        return view('lecturer.profile', [
            'user' => $user,
            'flashAlert' => $flashAlert
        ]);
    }

}
