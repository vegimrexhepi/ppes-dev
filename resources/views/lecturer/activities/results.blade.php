@extends('layouts.app-lecturer')
@section('title', 'Results')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

            <!-- Flash Messages -->
            @if (! is_null($flashAlert))
                @include('partials.errors', ['flashAlert' => $flashAlert])
            @endif

            <!-- KEY SECTION -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 key">
                        <div class="left-button">
                            <a href="{{ route('main.dashboard') }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END KEY SECTION -->

           <!-- HEADER TITLE-->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
                            <div class="tittle-middle">
                                <h3> Results</h3>
                            </div>
                    </div>
                 </div>
            </section>

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

                            @foreach ($activities as $activity)
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="{{ route('lecturer.activities.results.show', ['lecturer' => Auth::id(), 'activities' => $activity->id]) }}"><span class="activity-title pull-left">{{ $activity->title }}</span></a>
                                    <span class="student-toggle-on-off pull-right"> <button class="btn btn-link-2" onclick="window.location.assign({{ '"' . route('lecturer.activities.results.show', ['lecturer' => Auth::id(), 'activities' => $activity->id]) . '"' }})"><i class="fa fa-list-alt"></i> View</button> </span>
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
