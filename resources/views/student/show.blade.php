@extends('layouts.app-student')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities">
        <div class="top-content">

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
                                <h3> Results Activity One </h3>
                            </div>
                    </div>
                 </div>
            </section>
            <!-- BUTTONS LAYOUT -->

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container-fluid">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities single-results top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- <li> E para, nuk hin ne loop -->
                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bold-second">
                            <span class="activity-title-first no-padd pull-left">Criteria</span>
                            <span class="activity-title-first pull-right align-center">Bonus %</span>
                            <span class="activity-title-first pull-right align-center">Lect.</span>
                            <span class="activity-title-first pull-right align-center">Peers</span>
                        </li>
                        <!-- END OF ... -->

                        <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href=""><span class="activity-title pull-left">Average</span></a>
                            <a href=""><span class="activity-title pull-right align-center">n/a</span></a>
                            <a href=""><span class="activity-title pull-right align-center">n/a</span></a>
                            <a href=""><span class="activity-title pull-right align-center">4.0</span></a>
                        </li>

                        <div class="col-lg-4 col-lg-offset-4 col-md-5 col-md-offset-2 col-xs-12 col-sm-5 col-sm-offset-3">
                            <button class="submit-activity btn btn-link-2" type="submit" onclick="window.location.assign({{ '"'.route('student.activities.enrolled').'"' }})">
                                <i class="fa fa-arrow-circle-o-left"></i> Return to Activities
                            </button>
                        </div>

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
