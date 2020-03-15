@extends('layouts.app-lecturer')
@section('title', 'Edit Activity')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities">
        <!-- Top content -->
        <div class="top-content lecturer-bg-color">

            <!-- KEY SECTION -->
            @include('partials.key-section')

            <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6">
                <div>
                    <div class="form-box new-activity">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>EDIT: {!! $activity->title !!}</h3>
                            </div>
                        </div>
                        <div class="form-bottom login-form">
                            <form role="form" action="{{ route('lecturer.activities.postEdit', ['lecturer' => Auth::id(), 'activity_id' => $activity->id]) }}" method="POST">

                                {!! csrf_field() !!}

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label class="sr-only" for="form-activity">Activity Title</label>
                                    <input type="text" value="{!! $activity->title !!}" class="form-username form-control" id="form-username" name="title" placeholder="Activity Title">

                                    {{-- Display errors (if any) --}}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
											<strong>{{ $errors->first('title') }}</strong>
										</span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('criteria') ? ' has-error' : '' }}">
                                    <select class="form-control select2" multiple="multiple" name="criteria[]" data-placeholder="Enter criteria or select below..." style="width: 100%;">
                                        @foreach($existingCriteria as $criterion)
                                            <option value="{{ $criterion->name }}" @if(in_array($criterion->id, $activityCriteria)) selected="selected" @endif>{{ $criterion->name }}</option>
                                        @endforeach
                                    </select>

                                    {{-- Display errors (if any) --}}
                                    @if ($errors->has('criteria'))
                                        <span class="help-block">
											<strong>{{ $errors->first('criteria') }}</strong>
										</span>
                                    @endif
                                </div>

                                {{--<h3>Bonus Settings:</h3>
                                <div id="myforms">
                                    <div id='myform'>
                                        <input type='button' value='-' class='qtyminus' data-targeted-element-name='bonus1'>
                                        <input type='text' class='qty' name='bonus1' placeholder="0 %" value="0 %" title="Bonus 1 value">
                                        <input type='button' value='+' class='qtyplus' data-targeted-element-name='bonus1'>
                                    </div>
                                    <span class="diff">For a difference of ±0.5</span>
                                    --}}{{-- Display errors (if any) --}}{{--
                                    @if ($errors->has('bonus1'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('bonus1') }}</strong>
                                            </span>
                                    @endif

                                     <div class="clear"></div>

                                     <div id='myform'>
                                        <input type='button' value='-' class='qtyminus1' data-targeted-element-name='bonus2'>
                                        <input type='text' class='qty' name='bonus2' placeholder="0 %" value="0 %" title="Bonus 2 value">
                                        <input type='button' value='+' class='qtyplus1' data-targeted-element-name='bonus2'>
                                    </div>
                                    <span class="diff">For a difference from ±0.6 to ±1.0</span>
                                    --}}{{-- Display errors (if any) --}}{{--
                                    @if ($errors->has('bonus2'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('bonus2') }}</strong>
                                            </span>
                                    @endif

                                </div>--}}
                                <button type="submit" class="submit-activity btn btn-link-2"><i class="fa fa-floppy-o"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /.top-content --}}
    </div>
    {{-- /.lecturer-activities --}}

@section('libs')
    <script src="{{ asset('js/libs/select2.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('js/activities_create.js') }}"></script>
@endsection

@stop
