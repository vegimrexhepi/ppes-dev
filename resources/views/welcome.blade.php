@extends('layouts.app-lecturer')
@section('title', 'Login')

@section('content-wrapper')

    <!-- Top content -->
    <div class="top-content">

        <div class="inner-bg">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><i class="icons-ppes fa fa-desktop"></i><strong>PPES</strong></h1>
                        <div class="description">
                            <p>
                                Welcome to <strong>Peer Presentation Evaluation System</strong>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- /.row --}}
                <div class="social-login">
                    <h3>Continue as:</h3>
                    <div class="social-login-buttons">
                      <a href="{{ url('/login?role=lecturer') }}">
                        <button id="lecturer" class="btn btn-link-2" name="button">
                          <i class="fa fa-male"></i> Lecturer
                        </button>
                      </a>

                        <a href="{{ url('/login?role=student') }}">
                          <button id="student" class="btn btn-link-2"  name="button">
                            <i class="fa fa-graduation-cap"></i> Student
                          </button>
                        </a>

                    </div>
                </div>
                {{-- /.social-login --}}

            </div>
            {{-- /.container --}}
        </div>
        {{-- /.inner-bg --}}
    </div>
    {{-- .top-content --}}

@endsection

@section('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
