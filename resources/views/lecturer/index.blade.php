@extends('layouts.app-lecturer')
@section('title', 'Home')

@section('content')
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h2>Welcome Lecturer!</h2>
                        <br>
                        Hello <em>{{ $user->first_name.' '.$user->last_name }}</em>
                        <br><br>
                        You are logged in!
                        <br><br>
                        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection