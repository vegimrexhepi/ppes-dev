@extends('layouts.app-student')
@section('title', 'Profile')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities">
        <!-- Top content -->
        <div class="top-content">

            <!-- KEY SECTION -->
            @include('partials.key-section')


            <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6">
                <!-- Flash Messages -->
                @if (! is_null($flashAlert))
                    @include('partials.errors', ['flashAlert' => $flashAlert])
                @endif
                <div>
                    <div class="form-box new-activity">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Edit Profile</h3>
                            </div>
                        </div>
                        <div class="form-bottom profile-form">
                            <form role="form" action="{{ route('student.postEdit', ['lecturer' => Auth::id()]) }}" method="POST">

                                {!! csrf_field() !!}

                                {{-- First Name --}}
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-first-name">First name</label>
                                    <input required type="text" name="first_name" value="{{ $user->first_name }}" placeholder="First name..." class="form-first-name form-control" id="form-first-name">

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('first_name') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                {{-- Last Name --}}
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-last-name">Last name</label>
                                    <input required type="text" name="last_name" value="{{ $user->last_name }}" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('last_name') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                {{-- Student ID --}}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-email">Email</label>
                                    <input required type="text" name="student_id" value="{{ $user->student_id }}" placeholder="Student ID..." class="form-email form-control" id="form-student-id">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                {{-- Email --}}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-email">Email</label>
                                    <input required type="email" name="email" value="{{ $user->email }}" placeholder="Email..." class="form-email form-control" id="form-email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                {{-- Password --}}
                                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-password">Current Password</label>
                                    <input required type="password" name="current_password" placeholder="Current Password..." class="form-password form-control">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('current_password') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                <div class="change-password-student">
                                  <a id="change-password">Need to change password?
                                  </a>
                                </div>
                              <div id="change-password-hidden">
                                {{-- Password --}}
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-password">New Password</label>
                                    <input type="password" name="password" placeholder="New Password ..." class="form-password form-control" id="form-password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                    @endif
                                </div>

                                {{-- Confirm Password --}}
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-password-confirmation">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" placeholder="Confirm New Password (optional)..." class="form-password-confirmation form-control" id="form-password-confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                    @endif
                                </div>
                              </div>
                                {{-- Submit button --}}
                                <button type="submit" class="btn btn-link-2"><i class="fa fa-pencil-square-o"></i> Update</button>
                                <a href="{!! route('student.index') !!}" class="col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-offset-3 editbutton btn btnk-link-2 btn-danger"><i class="fa fa-ban"></i> 	&nbsp;Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}

@section('libs')
    <script src="{{ asset('js/libs/select2.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $("#change-password").click(function(){
          $("#change-password-hidden").slideDown(500);
      });
    });
    </script>
@endsection

@stop
