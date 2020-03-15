@extends('layouts.app-lecturer')
@section('title', 'Evaluating')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

            <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6">
                <div>
                    <div class="form-box new-activity activity-confirmation">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Evaluating: <strong>{{ $student->first_name . ' ' . $student->last_name }}</strong></h3>
                            </div>
                        </div>
                        <div class="form-bottom login-form">
                          {{--<div class="col-lg-8 col-xs-8 col-sm-8 col-md-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 active-connections bold-second"><p>Active connections:<span class="connections" id="active-connections">0</span></p></div>
                            <div class="clearfix"> </div>
                          <div class="col-lg-8 col-xs-8 col-sm-8 col-md-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 active-connections bold-second"><p>Votes submitted: <span class="casted" id="votes-casted">0</span></p></div>
                            <div class="clearfix"> </div>--}}
                            <h3 class="align-center">Evaluation in progress...</h3>
                            <div class="clock col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-3"></div>
                             <p class="align-center">Please wait until the time expires.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="expire-url-provider" data-url="/ppes/public/lecturer/evaluating/expired/activity/{{$activityId}}/student/{{$student->id}}" style="display: none;"></div>

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/libs/flipclock.min.js') }}"></script>
    <script src="{{ asset('js/libs/pusher.min.js') }}"></script>
    <script>
    $(document).ready(function() {

        // Instantiate a counter
        var clock = new FlipClock($('.clock'), 60, {
            clockFace: 'Counter',
            autoStart: true,
            countdown: true
        });

        setTimeout(function() {

            var ajaxUrl = String($("#expire-url-provider").data('url'));
            console.log($("#expire-url-provider").data('id'))
            $.get( ajaxUrl, function( data ) {
                if(data == 1){
                    window.location.href = '/ppes/public/'; //one level up
                }
            });

        }, 60000);


        // Handle active connections and votes casted
        function updateActiveConnections(data) {
            var activeConnections = $("#active-connections");
            var activeConnectionsValue = parseInt(activeConnections.text());
            activeConnections.html(activeConnectionsValue + 1);
            console.log(data);
        }

        var pusher = new Pusher('d7caafff626eb58f53b8', {
          cluster: 'eu',
          forceTLS: true
        });
        var channel = pusher.subscribe('ppes.student-evaluation-channel');
        channel.bind('ppes.student-evaluation-joined', updateActiveConnections);

    });
    </script>
@stop
