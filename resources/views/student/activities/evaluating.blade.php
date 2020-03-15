@extends('layouts.app-student')
@section('title', 'Evaluating')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities">
        <div class="top-content">


            <section id="evaluating-active" style="display: none;">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 criteria-top top-title">
                        <div class="tittle-middle">
                            <h3 id="activeStudent"> Evaluating </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities criteria top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <li> E para, nuk hin ne loop -->
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="col-xs-4 activity-title-first pull-left">Criterion</span>

                            </li>
                            <!-- END OF ... -->

                            <form action="{{ route('student.activities.evaluating.store') }}" method="post">

                                {{ csrf_field() }}

                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <input type="hidden" id="student_id" name="student_id" value="">

                                @foreach($activity->criteria as $criterion)
                                    <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <a href=""><span class="col-xs-4 activity-title pull-left">{{ $criterion->name }}</span></a>
                                        <input type="hidden" name="criterion_id_{{ $criterion->id }}" value="{{ $criterion->id }}">
                                        <span class="col-xs-4 ratings pull-right">
                                           <select class="rate" name="vote[{{ $criterion->id }}]">
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                               <option value="5">5</option>
                                           </select>
                                        </span>
                                    </li>
                                @endforeach
                                <div class="col-lg-3 col-xs-12 pull-right">
                                    <button type="submit" class="submit-activity btn btn-link-2">Submit</button>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="evaluating-not-active">
                @if (! is_null($flashAlert))
                    @include('partials.errors', ['flashAlert' => $flashAlert])
                @endif
                <div class="container please-wait">
                    <h3 class="on-top">Please wait until a student is activated...</h3>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities criteria top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <li> E para, nuk hin ne loop -->
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="col-xs-4 activity-title-first pull-left">Criterion</span>

                            </li>
                            <!-- END OF ... -->

                            @foreach($activity->criteria as $criterion)
                                <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <a href=""><span class="col-xs-4 activity-title pull-left">{{ $criterion->name }}</span></a>
                                    <span class="col-xs-4 ratings pull-right">
                                       <select class="rate" name="criterion_id">
                                           <option value="1">1</option>
                                           <option value="2">2</option>
                                           <option value="3">3</option>
                                           <option value="4">4</option>
                                           <option value="5">5</option>
                                       </select>
                                    </span>
                                </li>
                            @endforeach
                            {{--<div class="col-lg-3 col-xs-12 pull-right">
                                <button type="submit" class="submit-activity btn btn-link-2">Submit</button>
                            </div>--}}
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
    <script src="{{ asset('js/libs/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('js/libs/pusher.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {

            function activateEvaluation(message) {

                $("#evaluating-not-active").fadeOut(200, function() {

                    $("#evaluating-active").fadeIn(200);

                    $(this).remove();
                    $('#student_id').val(message.student_id);
                    $('#activeStudent').text(message.response);
                    console.log(message.response);


                });

            }

            function redirectUser(data) {

                window.location.assign('/student/activities/expired');

            }

            var pusher = new Pusher('d7caafff626eb58f53b8', {
              cluster: 'eu',
              forceTLS: true
            });
            var channel = pusher.subscribe('ppes.student-evaluation-channel');
            channel.bind('ppes.student-evaluation-started', activateEvaluation);
            channel.bind('ppes.student-evaluation-expired', redirectUser);




            $(function() {
                $('.rate').barrating({
                    theme: 'bootstrap-stars'
                });
            });

        });
    </script>
@stop
