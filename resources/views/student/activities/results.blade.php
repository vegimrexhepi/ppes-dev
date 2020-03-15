@extends('layouts.app-student')
@section('title', 'Results')

@section('content')
	<div id="template-with-sidebar" class="lecturer-activities">
	    <div class="top-content">

            <!-- Flash Messages -->
            @if (! is_null($flashAlert))
                @include('partials.errors', ['flashAlert' => $flashAlert])
            @endif

            <!-- KEY SECTION -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 key">
                            <div class="left-button">
                             <button class="btn btn-link-2">
                                <i class="fa fa-arrow-left"></i></button>
                            </div>
                    </div>
                </div>
            </section>
            <!-- END KEY SECTION -->

            <!-- BUTTONS LAYOUT - SECTIONS ARE JUST FOR MORE CLARIFICATIONS, YOU CAN USE DIVs without section.. -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
                            <div class="tittle-middle">
                                <h3>Results</h3>
                            </div>
                    </div>
                 </div>
            </section>
            <!-- BUTTONS LAYOUT -->

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities result-page top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12 live-search-list">
                            <!-- <li> E para, nuk hin ne loop -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searching-live">
                                <span class="activity-title-first pull-left bold-second">Activity Name</span>
                                <span class="student-toggle-first pull-right search-form-mobile">
                                <div class="input-group search-input-group">
                                  <span class="search-icon"><i class="fa fa-search"></i></span>
                                 <input type="text" class="form-control live-search-box" placeholder="Search...">
                                </div>
                                </span>
                            </div>
                            <!-- END OF ... -->

                            @if ($activities)
                                @foreach ($activities as $activity)
                                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a href="{{ route('student.activities.results_show', $activity->id) }}">
                                            <span class="activity-title center-mobile-100 pull-left">{{ $activity->title }}</span>
                                        </a>
                                        <span class="student-toggle-on-off pull-right">
                                            <button class="btn btn-link-2 show-student" data-url="{{ route('student.activities.results_show', $activity->id) }}"><i class="fa fa-list-alt"></i> View</button>
                                        </span>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                </div>
            </section>

	    </div>
	    <!-- /.top-content -->
	</div>
	<!-- /#template-with-sidebar -->
@endsection

@section('scripts')
    <script type="text/javascript">
    jQuery(document).ready(function() {

        /*
        |--------------------------------------------------------------------------
        | Bind button's "click" event to navigate on student's view page
        |--------------------------------------------------------------------------
        |
        */
        (function navigateToStudentViewPage() {
            var showStudentButton = $(".show-student");

            showStudentButton.on("click", function() {

                var urlToNavigate = String($(this).data('url'));
                window.location.assign(urlToNavigate);

            });
        })();

    });
    </script>

		<script src="{{ asset('js/live_search.js') }}"></script>
@stop
