@extends('layouts.app-student')
@section('title', !is_null($activity) ? $activity->title : '(activity not found)')


@section('content')
    <div id="template-with-sidebar" class="lecturer-activities show-key">
        <div class="top-content">

            <!-- KEY SECTION -->
            <section>
  	            <div class="container-fluid">
  	                <div class="col-lg-12 key">
                          <div class="left-button">
                           	<a href="{{ route('student.activities.enrolled') }}"><button class="btn btn-link-2"><i class="fa fa-arrow-left"></i></button></a>
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
                            <h3>{{ ! is_null($activity) ? $activity->title : '(activity not found)' }} </h3>
                        </div>
                    </div>
                </div>
            </section>
            <!-- BUTTONS LAYOUT -->

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities dec-no result-page student-activity-page top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <li> E para, nuk hin ne loop -->
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="activity-title-first pd-left-20 pull-left bold-second">You will be evaluated for the following criteria:</span>
                            </li>
                            <!-- END OF ... -->
                            @foreach($activity->criteria as $criterion)
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="activity-title center-mobile-100 pull-left">{!! $criterion->name !!}</span>
                            </li>
                            @endforeach
                            <!-- <div class="col-lg-4 col-lg-offset-4 col-md-5 col-md-offset-2 col-xs-12 col-sm-5 col-sm-offset-3">
                                <button class="submit-activity btn btn-link-2" type="submit"><i class="fa fa-arrow-circle-o-left"></i> Return to Activities</button>
                            </div> -->
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
