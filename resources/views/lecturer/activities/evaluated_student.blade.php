@extends('layouts.app-lecturer')
@section('title', 'Evaluation Complete')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

            <!-- KEY SECTION -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 key">
                            <div class="left-button">
                             <button class="btn btn-link-2">
                                <i class="fa fa-arrow-left"></i></button>
                            </div>
                        <p>Access Key: <b>5555</b></p>
                    </div>
                </div>
            </section>

            <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6">
                <div>
                    <div class="form-box new-activity activity-confirmation">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Evaluation Complete</h3>
                            </div>
                        </div>
                        <div class="form-bottom login-form">
                            <h3><strong>{{ $student->first_name . ' ' . $student->last_name }}'s</strong> evaluation has finished!</h3>
                            <h3>Please evaluate to enable bonuses.</h3>
                             <br>
                             <p>Note: You can also evaluate later by visiting the Results section for the Activity, then evaluating each student!</p>
                             <a href="{{ route('lecturer.activities.evaluate.student', ['lecturer' => $lecturerId, 'activities' => $activityId, 'student' => $student->id]) }}"><button type="submit" class="vote submit-activity btn btn-link-2">Evaluate Now</button></a>
                             <button type="submit" class="submit-activity btn btn-link-2" onclick="window.location.assign({{ '"' . route('lecturer.activities.results.show', ['lecturer' => $lecturerId, 'activities' => $activityId]) . '"' }})">Return to Activity</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}
@endsection
