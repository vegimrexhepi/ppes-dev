@extends('layouts.app-lecturer')
@section('title', $activity->title)

@section('content')
	<div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

			<!-- KEY SECTION -->
	        <section>
	            <div class="container-fluid">
	                <div class="col-lg-12 key">
                        <div class="left-button">
                         	<a href="{{ route('lecturer.activities.index', ['lecturer' => Auth::id()]) }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
                        </div>
	                    <p>Access Key: <b style="text-transform: uppercase; padding: 7px; background: rgba(0, 0, 0, 0.35);">{{ $activity->access_code }}</b></p>
	                </div>
	            </div>
	        </section>

			<!-- ACTIVITY'S TITLE -->
	        <section>
	            <div class="container-fluid">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
	                        <div class="tittle-middle">
	                            <h3>{{ $activity->title }}</h3>
	                        </div>
	                </div>
	             </div>
	        </section>

			<!-- LIST OF STUDENTS -->
		    <section>
		        <div class="container-fluid">
		            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities top-title">
		                <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12 live-search-list">
			                <!-- <li> E para, nuk hin ne loop -->
			                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bold-second searching-live">
			                    <span class="activity-title-first activity-id pull-left">ID</span>
			                    <span class="activity-title-first pull-left">Student Name</span>
			                    <span class="student-toggle-first pull-right search-form-mobile">
			                    <div class="input-group search-input-group">
			                      <span class="search-icon"><i class="fa fa-search"></i></span>
			                     <input type="text" class="form-control live-search-box" placeholder="Search...">
			                    </div>
			                    </span>
			                </div>

							@foreach($enrolledStudents as $student)
								<li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href=""><span class="activity-title activity-id pull-left">{{ $student->student_id }}</span><span class="activity-title pull-left">{{ $student->first_name . ' ' . $student->last_name }}</span></a>
									<!-- <span class="student-toggle-on-off pull-right"> <input type="checkbox" class="switch switch-on-off" data-backdrop="static" data-keyboard="false" /></span> -->
									<div class="settings-open presenting activity-open" id="settingopen-{{$student->user_id}}">
										<div id="activating" class="enrollment presenting">
											<p><span class="blink"><i class="fa fa-user"></i>Presentation on going...</span></p>
										</div>
										<div id="activating" class="presenting edit-settings">
											<a href="{{ route('lecturer.activities.evaluating.student', [$lecturerId, $activity->id, $student->user_id] ) }}"><button class="btn btn-link-2">Activate Voting</button></a>
										</div>
									</div>
									@if($student->completed != 1)
											<button id="click-show-modal" class="student-presenting btn btn-link-2 click-show-modal" name="button" data-id="{{$student->user_id}}">	<i class="fa fa-play"></i> Start</button>
									@else
										<a id="completed-presentation" class="student-presenting" name="button">	<i class="fa fa-check"></i> Completed</a>
									@endif
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
			<!-- Modal -->
<div class="container lecturer-bg-color">
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Attention</h4>
				</div>
				<div class="modal-body">
					Please ask the audience to join for evaluation while the presentation is ongoing and before activating evaluation.<br>
					Press ACTIVATE when ready to start receiving votes from audience.
				</div>
				<div class="modal-footer">
					<button id="hide-presentation" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript">

		$(".switch-on-off").bootstrapSwitch();

		$('.switch-on-off').on('switchChange', function (e, data) {

			$('.switch-on-off').bootstrapSwitch('state', !data, true);

		});

		$(".modal-footer .btn-primary").click(function(){
			$('.switch-on-off').bootstrapSwitch('toggleState', true, true);
			$('#showModal').modal('hide');
		});

		$("#click-show-modal").click(function() {
			$("button#click-show-modal").css("opacity", "0.5");
		});
		(function blink() {
    $('.blink i').css("color", "#ff0000").fadeOut(400).css("color", "#00a65a").fadeIn(700, blink);
})();


$("#disabled-check *").attr("disabled", "disabled").off('click');

	</script>

	<script src="{{ asset('js/live_search.js') }}"></script>
@endsection
