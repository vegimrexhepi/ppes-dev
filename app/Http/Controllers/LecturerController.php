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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->get('password')){
            $rules = [
                'first_name'     => 'required',
                'last_name'     => 'required',
                'email'  => 'required|email',
                'password'  => 'required|min:6',
                'password_confirmation'  => 'required|same:password'
            ];
        }else{
            $rules = [
                'first_name'     => 'required',
                'last_name'     => 'required',
                'email'  => 'required|email'
            ];
        }

        // Validate the data taken from the request
        $this->validate($request, $rules);

        $flashAlert = new \stdClass();
        try {
            $user = User::find($id);
            $password = $request->get('current_password');
            if(Hash::check($password, $user->password)){
                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->email = $request->get('email');
                //return $request->input('criteria');

                $user->save();

                $flashAlert->type    = 'success';
                $flashAlert->content = 'Your profile was edited successfully';

                $request->session()->flash('flash_alert', $flashAlert);

                return redirect()->route('lecturer.activities.index', [
                    'lecturer' => $id
                ]);
            }else{
                $flashAlert->type    = 'danger';
                $flashAlert->content = 'Enter the correct password';

                $request->session()->flash('flash_alert', $flashAlert);

                return back();
            }



        } catch (ModelNotFoundException $e) {

            // Define flash alert object
            $flashAlert->type    = 'danger';
            $flashAlert->content = 'User not found in the database';

            $request->session()->flash('flash_alert', $flashAlert);

            return redirect()->route('lecturer.activities.index', [
                'lecturer' => $id
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
