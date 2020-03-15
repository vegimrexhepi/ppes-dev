@extends('layouts.app-student')
@section('title', ! is_null($activity) ? $activity->title : '(activity not found)')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities show-key">
        <div class="top-content">

            <!-- KEY SECTION -->
            <section>
  	            <div class="container-fluid">
  	                <div class="col-lg-12 key">
                          <div class="left-button">
                           	<a href="{{ route('student.activities.results') }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
                          </div>
  	                </div>
  	            </div>
  	        </section>

            <!-- BUTTONS LAYOUT - SECTIONS ARE JUST FOR MORE CLARIFICATIONS, YOU CAN USE DIVs without section.. -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-title">
                        <div class="tittle-middle">
                            <h3> Results: {{ ! is_null($activity) ? $activity->title : '(activity not found)' }} </h3>
                        </div>
                    </div>
                </div>
            </section>

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities single-results top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <li> E para, nuk hin ne loop -->
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bold-second">
                                <span class="activity-title-first no-padd pull-left">Criterion</span>
                                <span class="activity-title-first pull-right align-center">Lecturer</span>
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
                                    <span class="activity-title-first no-padd pull-left">{{ $name }}</span>
                                    <span class="activity-title-first pull-right align-center">@if($result['lecturer_avg'] != 0){{ round($result['lecturer_avg'], 1) }}@else n/a @endif</span>
                                    <span class="activity-title-first pull-right align-center">{{ round($result['student_avg'], 1) }}</span>
                                </li>
                            @endforeach


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

    </script>
@stop
