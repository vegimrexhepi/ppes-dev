@extends('layouts.app-lecturer')
@section('title', 'Results '.$activity->title)

@section('content')
	<div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

			<!-- KEY SECTION -->
	        <section>
	            <div class="container-fluid">
	                <div class="col-lg-12 key">

						<div class="left-button">
							<a href="{{ route('lecturer.activities.results', ['lecturer' => Auth::id()]) }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
						</div>
						@if($attention == 1)
	                    <div class="pull-right results-activity-attention">
	                      <p>Please evaluate!</p>
	                    </div>
						@endif
	                </div>
	            </div>
	        </section>
	        <!-- END KEY SECTION -->

	        <!-- ACTIVITY'S TITLE -->
	        <section>
	            <div class="container-fluid">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
	                        <div class="tittle-middle">
	                            <h3> Results: {{ $activity->title }}</h3>
	                        </div>
	                </div>
	             </div>
	        </section>
	        <!-- BUTTONS LAYOUT -->

	        <!-- LIST OF ACTIVITIES -->
	        <section>
	            <div class="container-fluid">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities result-activity top-title">
	                    <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12 live-search-list">
	                    <!-- <li> E para, nuk hin ne loop -->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searching-live">
		                        <span class="activity-title-first col-xs-6 pull-left pdr-0 center-mobile bold-second">Student Name</span>
		                        <span class="activity-title-first col-xs-6 pull-left avg center-mobile bold-second">Peer Avg</span>
		                        <span class="student-toggle-first pull-right search-form-mobile">
		                        <div class="input-group search-input-group">
		                          <span class="search-icon"><i class="fa fa-search"></i></span>
		                         <input type="text" class="form-control live-search-box" placeholder="Search...">
		                        </div>
		                        </span>
		                    </div>
							@foreach($students as $student)
		                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                        <a href="{{ route('lecturer.activities.results.student.show', ['lecturer' => Auth::id(), 'activities' => $activity->id, 'student' => $student['student']->id]) }}"><span class="activity-title col-xs-6 rmv-left-padd-m pull-left">{{ $student['student']->first_name." ".$student['student']->last_name }}</span></a>
		                        <a href=""><span class="activity-title col-xs-6 pull-left avg center-mobile">{{ round($student['average'], 1) }}</span></a>
		                        <span class="student-toggle-on-off pull-right"> <a href="">
										@if($student['evaluated_by_lecturer'] != 1)
											<span class="activity-attention-needed">!</span></a>
										@endif
									<a href="{{ route('lecturer.activities.results.student.show', ['lecturer' => Auth::id(), 'activities' => $activity->id, 'student' => $student['student']->id]) }}"><button class="btn btn-link-2"><i class="fa fa-info-circle"></i> Details</button></a> </span>
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

		@section('scripts')
			<script src="{{ asset('js/live_search.js') }}"></script>
		@endsection

@endsection
