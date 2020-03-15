@extends('layouts.app-lecturer')
@section('title', 'Results '.$student->first_name . ' ' . $student->last_name )

@section('content')
	<div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

        <!-- KEY SECTION -->
        <section>
            <div class="container-fluid">
                <div class="col-lg-12 key">
                        <div class="left-button">
                            <a href="{{ route('lecturer.activities.results.show', ['lecturer' => Auth::id(), 'activity' => $activity->id]) }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
                        </div>
                    @if($overallLecturer == 0)
                    <div class="pull-right results-activity-vote">
                      <p><a href="{{ route('lecturer.activities.evaluate.student', ['lecturer' => $lecturerId, 'activities' => $activity->id, 'student' => $student->id]) }}">Evaluate Now</a></p>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- BUTTONS LAYOUT - SECTIONS ARE JUST FOR MORE CLARIFICATIONS, YOU CAN USE DIVs without section.. -->
        <section>
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
                        <div class="tittle-middle">
                            <h3> Results: {{ $student->first_name . ' ' . $student->last_name }} - {{ $activity->title }}</h3>
                        </div>
                </div>
             </div>
        </section>

        <!-- LIST OF ACTIVITIES -->
        <section>
            <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities results-criterion single-results top-title">
                    <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!-- <li> E para, nuk hin ne loop -->
                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bold-second">
                        <span class="activity-title-first no-padd pull-left">Criterion</span>
                        <span class="activity-title-first pull-right align-center">You</span>
                        <span class="activity-title-first pull-right align-center">Peer</span>
                    </li>
                    <!-- END OF ... -->


                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-style: italic;">
                        <span class="activity-title-first no-padd pull-left">Overall Average</span>
                        <span class="activity-title-first pull-right align-center">@if($overallLecturer != 0){{ round($overallLecturer, 1) }}@else n/a @endif</span>
                        <span class="activity-title-first pull-right align-center">{{ round($overallStudent, 1) }}</span>
                    </li>

                    @foreach ($results as $name => $result)
	                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                        <span class="activity-title w-200 pull-left">{{ $name }}</span>
	                        <span class="activity-title pull-right align-center">@if($result['lecturer_avg'] != 0){{ round($result['lecturer_avg'], 1) }}@else n/a @endif</span>
	                        <span class="activity-title pull-right align-center">{{ round($result['student_avg'], 1) }}</span>
	                    </li>
                    @endforeach


                    </ul>
                </div>
            </div>
        </section>

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}
@endsection
