@extends('layouts.app-lecturer')
@section('title', 'Activities')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities enr-md">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color alert-regulation">

            <!-- Flash Messages -->
            @if (! is_null($flashAlert))
                @include('partials.errors', ['flashAlert' => $flashAlert])
            @endif


            <!-- BUTTONS LAYOUT - SECTIONS ARE JUST FOR MORE CLARIFICATIONS, YOU CAN USE DIVs without section.. -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title new-activ">
                        <div class="tittle-middle col-md-6">
                            <h3> Activities</h3>
                        </div>

                        <a href="{{ route('lecturer.activities.create', ['lecturer' => Auth::id()]) }}">
                          <div class="create-new pull-right results-activity-vote">
                            <i class="fa fa-plus"></i>
                            &nbsp;Create New
                          </div>
                        </a>
                    </div>
                    <!-- ADD BUTTON -->
                    <div class="right-button">
                        <a href="{{ route('lecturer.activities.create', ['lecturer' => Auth::id()]) }}">
                            <button class="btn btn-link-2"><i class="fa fa-plus"></i></button>
                        </a>
                    </div>
                </div>
            </section>

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12 live-search-list">
                            <!-- <li> E para, nuk hin ne loop -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 searching-live">
                                <span class="col-xs-6 activity-title-first pull-left">Activity Name</span>
                                <span class="student-toggle-first pull-right search-form-mobile">
                                    <div class="input-group search-input-group">
                                            <span class="search-icon"><i class="fa fa-search"></i></span>
                                            <input type="text" class="form-control live-search-box" placeholder="Search...">
                                    </div>
                                </span>
                            </div>

                            @foreach ($activities as $activity)
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href="{{ route('lecturer.activities.show', ['lecturer' => Auth::id(), 'activities' => $activity->id]) }}"><span class="activity-title activity-mob pull-left">{{ $activity->title }}</span></a>
                                    <div class="settings-open activity-open">
                                        <div class="enrollment"><p><em>Enrollment link:</em></p>
                                            <input id="copytarget-{!! $activity->id !!}" type="text" value="{{ $activity->invitation_link.'/'.$activity->enrollment_key }}"><button data-clipboard-copy="" data-clipboard-target="#copytarget-{!! $activity->id !!}" class="btn btn-link-2"><i class="fa fa-clipboard"></i> Copy</button>
                                        </div>
                                        <div class="edit-settings">
                                            <button class="btn btn-link-2"
                                                onclick="window.location.assign({{ '"' . route('lecturer.activities.edit', ['lecturer' => Auth::id(), 'activities' => $activity->id]) . '"' }})"><i class="fa fa-pencil-square-o"></i>Edit
                                            </button>
                                        </div>
                                    </div>
                                    <div class="student-click">
                                        <a><i class="fa fa-cog"></i></a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </section>

        </div>
        {{-- /.top-content --}}
    </div>

    @section('scripts')
  		<script src="{{ asset('js/live_search.js') }}"></script>
        <script src="{{ asset('js/libs/clipboard.js') }}"></script>
        <script type="text/javascript">
            var clipboardDemos = new Clipboard('[data-clipboard-copy]');

            clipboardDemos.on('success', function(e) {
                e.clearSelection();

                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

            });

            clipboardDemos.on('error', function(e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);

                showTooltip(e.trigger, fallbackMessage(e.action));
            });
        </script>
  	@endsection

    {{-- /.lecturer-activities --}}
@endsection
