@extends('layouts.app-lecturer')
@section('title', 'Evaluate Student')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities activity-details">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

            <!-- BUTTONS LAYOUT - SECTIONS ARE JUST FOR MORE CLARIFICATIONS, YOU CAN USE DIVs without section.. -->
            <section>
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 criteria-top top-title">
                        <div class="tittle-middle">
                            <h3> Evaluating: <strong>{{ $student->first_name . ' ' . $student->last_name }}</strong></h3>
                        </div>
                    </div>
                 </div>
            </section>

            <!-- LIST OF ACTIVITIES -->
            <section>
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-activities criteria top-title">
                        <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- <li> E para, nuk hin ne loop -->
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="col-xs-4 activity-title-first pull-left">Please rate every criterion.</span>
                            </li>

                            <form action="{{ route('lecturer.activities.evaluateStudentStore') }}" method="post">

                                {{ csrf_field() }}

                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <input type="hidden" id="student_id" name="student_id" value="{!! $student->id !!}">

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

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/libs/jquery.barrating.min.js') }}"></script>
    <script>
        $(function() {
            $('.rate').barrating({
                theme: 'bootstrap-stars'
            });
        });
    </script>
@stop
