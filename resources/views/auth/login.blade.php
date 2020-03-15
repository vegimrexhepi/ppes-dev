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

                @if ($role == 'lecturer')

                    <div class="loginandregister">

                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">

                                <!-- START LECTURER LOGIN FORM -->
                                <div id="login-lecturer">
                                    <div class="form-box">
                                        <div class="form-top">
                                            <div class="form-top-left">
                                                <h3>Lecturer Login</h3>
                                                <p>Enter username and password to log on:</p>
                                            </div>
                                            <div class="form-top-right">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <div class="form-bottom">
                                            {{-- Login Form --}}
                                            <form role="form" action="{{ url('/login') }}" method="POST" class="login-form">

                                                {!! csrf_field() !!}

                                                {{-- Email --}}
                                                <div class="form-group{{ $errors->has('email') || $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-username">Username</label>
                                                    <input type="email" required name="email" value="{{ old('email') }}" placeholder="Email..." class="form-username form-control" id="form-username">
                                                </div>

                                                {{-- Password --}}
                                                <div class="form-group{{ $errors->has('password') || $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-password">Password</label>
                                                    <input type="password" required name="password" placeholder="Password..." class="form-password form-control" id="form-password">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Submit button --}}
                                                <button type="submit" class="btn btn-link-2"><i class="fa fa-sign-in"></i>SIGN IN</button>

                                                <div class="clearfix"></div>

                                                {{-- Forgot your password --}}
                                                <div class="forgot-y-p"><a id="forgot-password-lecturer" href="#password-reset-lecturer">Forgot your password?</a></div>

                                                <div class="or">
                                                    <p>or</p>
                                                </div>

                                                {{-- Register new account --}}
                                                <a id="register-lecturer-login" class="btn btn-link-2" href="#register-lecturer">
                                                    Register New Account
                                                </a>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END LECTURER LOGIN FORM -->

                                <!-- START RESET LECTURER PASSWORD -->
                                <div id="password-reset-lecturer" class="lecturer-bg-color">
                                    <div class="form-box">
                                        <div class="form-top">
                                            <div class="form-top-left">
                                                <h3>Lecturer Password Reset</h3>
                                            </div>
                                            <div class="form-top-right">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <div class="form-bottom">
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            {{-- Reset password Form --}}
                                            <form role="form" action="{{ url('/password/email') }}" method="POST" class="login-form">

                                                {!! csrf_field() !!}

                                                {{-- Email --}}
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-password">E-mail</label>
                                                    <input required type="email" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail..." class="form-password form-control" id="form-password">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Reset password button --}}
                                                <button type="submit" class="btn">Send reset link</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END RESET LECTURER PASSWORD -->

                            </div>
                        </div>
                        {{-- /.row --}}

                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">

                                <!-- START LECTURER REGISTER FORM -->
                                <div id="register-lecturer" class="lecturer-bg-color">
                                    <div class="form-box">
                                        <div class="form-top">
                                            <div class="form-top-left">
                                                <h3>Lecturer Register</h3>
                                                <p>Fill in the form below to get instant access:</p>
                                            </div>
                                            <div class="form-top-right">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                        </div>
                                        <div class="form-bottom">

                                            {{-- Register Form --}}
                                            <form role="form" action="{{ url('/register') }}" method="POST" class="registration-form">

                                                {!! csrf_field() !!}

                                                {{-- First Name --}}
                                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-first-name">First name</label>
                                                    <input required type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First name..." class="form-first-name form-control" id="form-first-name">

                                                    @if ($errors->has('first_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Last Name --}}
                                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-last-name">Last name</label>
                                                    <input required type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">

                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Email --}}
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-email">Email</label>
                                                    <input required type="email" name="email" value="{{ old('email') }}" placeholder="Email..." class="form-email form-control" id="form-email">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Password --}}
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-password">Password</label>
                                                    <input required type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- Confirm Password --}}
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <label class="sr-only" for="form-password-confirmation">Password</label>
                                                    <input required type="password" name="password_confirmation" placeholder="Confirm Password..." class="form-password-confirmation form-control" id="form-password-confirmation">

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- User's Role --}}
                                                <input type="hidden" name="role" value="lecturer">

                                                {{-- Submit button --}}
                                                <button type="submit" class="btn">Sign me up!</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- END LECTURER REGISTER FORM -->

                            </div>
                        </div>
                        {{-- .row --}}

                    </div>
                    {{-- /.loginandregister --}}

                @else

                    @if ($role == 'student')

                        <div class="loginandregister">

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">

                                    <!-- START STUDENT LOGIN FORM -->
                                    <div id="login-student">
                                        <div class="form-box">
                                            <div class="form-top">
                                                <div class="form-top-left">
                                                    <h3>Student Login</h3>
                                                    <p>Enter username and password to log on:</p>
                                                </div>
                                                <div class="form-top-right">
                                                    <i class="fa fa-lock"></i>
                                                </div>
                                            </div>
                                            <div class="form-bottom">

                                                {{-- Login Form --}}
                                                <form role="form" action="{{ url('/login') }}" method="POST" class="login-form">

                                                    {!! csrf_field() !!}

                                                    {{-- Email --}}
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-username">Username</label>
                                                        <input type="email" required name="email" value="{{ old('email') }}" placeholder="Email..." class="form-username form-control" id="form-username">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Password --}}
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-password">Password</label>
                                                        <input required type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Submit button --}}
                                                    <button type="submit" class="btn btn-link-2"><i class="fa fa-sign-in"></i>SIGN IN</button>

                                                    <div class="clearfix"></div>

                                                    {{-- Forgot your password --}}
                                                    <div class="forgot-y-p"><a id="forgot-password-student" href="#password-reset-student">Forgot your password?</a></div>

                                                    <div class="or">
                                                        <p>or</p>
                                                    </div>

                                                    {{-- Register new account --}}
                                                    <a id="register-student-login" class="btn btn-link-2" href="#register-student">
                                                        Register New Account
                                                    </a>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END STUDENT LOGIN FORM -->

                                    <!-- START RESET STUDENT PASSWORD -->
                                    <div id="password-reset-student">
                                        <div class="form-box">
                                            <div class="form-top">
                                                <div class="form-top-left">
                                                    <h3>Student Password Reset</h3>
                                                </div>
                                                <div class="form-top-right">
                                                    <i class="fa fa-lock"></i>
                                                </div>
                                            </div>
                                            <div class="form-bottom">
                                                @if (session('status'))
                                                    <div class="alert alert-success">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                {{-- Reset password Form --}}
                                                <form role="form" action="{{ url('/password/email') }}" method="POST" class="login-form">

                                                    {!! csrf_field() !!}

                                                    {{-- Email --}}
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-password">E-mail</label>
                                                        <input required type="email" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail..." class="form-password form-control" id="form-password">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Reset password button --}}
                                                    <button type="submit" class="btn">Send reset link</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END RESET STUDENT PASSWORD -->

                                </div>
                            </div>
                            {{-- /.row --}}

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">

                                    <!-- START STUDENT REGISTER FORM -->
                                    <div id="register-student">
                                        <div class="form-box">
                                            <div class="form-top">
                                                <div class="form-top-left">
                                                    <h3>Student Register</h3>
                                                    <p>Fill in the form below to get instant access:</p>
                                                </div>
                                                <div class="form-top-right">
                                                    <i class="fa fa-pencil"></i>
                                                </div>
                                            </div>
                                            <div class="form-bottom">

                                                {{-- Register Form --}}
                                                <form role="form" action="{{ url('/register') }}" method="POST" class="registration-form">

                                                    {!! csrf_field() !!}

                                                    {{-- First Name --}}
                                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-first-name">First name</label>
                                                        <input required type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First name..." class="form-first-name form-control" id="form-first-name">

                                                        @if ($errors->has('first_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('first_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Last Name --}}
                                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-last-name">Last name</label>
                                                        <input required type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">

                                                        @if ($errors->has('last_name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('last_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Student ID --}}
                                                    <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-student-id">Last name</label>
                                                        <input required type="text" name="student_id" value="{{ old('student_id') }}" placeholder="Student ID..." class="form-student-id form-control" id="form-student-id">

                                                        @if ($errors->has('student_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('student_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Email --}}
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-email">Email</label>
                                                        <input required type="email" name="email" value="{{ old('email') }}" placeholder="Email..." class="form-email form-control" id="form-email">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Password --}}
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-password">Password</label>
                                                        <input required type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">

                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Confirm Password --}}
                                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                        <label class="sr-only" for="form-password-confirmation">Password</label>
                                                        <input required type="password" name="password_confirmation" placeholder="Confirm Password..." class="form-password-confirmation form-control" id="form-password-confirmation">

                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- User's Role --}}
                                                    <input type="hidden" name="role" value="student">

                                                    {{-- Submit button --}}
                                                    <button type="submit" class="btn">Sign me up!</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- END STUDENT REGISTER FORM -->

                                </div>
                            </div>
                            {{-- /.row --}}

                        </div>
                        {{-- /.loginandregister --}}

                    @else

                        {{-- If no valid role is provided --}}
                        <span id="wrong-role-provided" style="display: none;"></span>

                    @endif

                @endif

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
