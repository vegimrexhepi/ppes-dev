@extends('layouts.app-student')
@section('title', 'Join to Evaluate')

@section('content')

    <div id="template-with-sidebar" class="lecturer-activities">
        <div class="top-content">


          <!-- Flash Messages -->
          @if (! is_null($flashAlert))
              @include('partials.errors', ['flashAlert' => $flashAlert])
          @endif
            <!-- KEY SECTION -->
             <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6 criteria-top">
                <div>

                    <div class="form-box new-activity activity-confirmation">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Join to Evaluate</h3>
                            </div>
                        </div>
                        <div class="form-bottom login-form">
                            <h4 class="font-regulation">Please enter the key provided by the Lecturer</h4><br>
                            <form class="evaulate-peers" action="{{ route('student.activities.join') }}" method="post">
                                {{ csrf_field() }}

                                <input required type="text" name="access_code" placeholder="Access Key"><br>
                                <button class="submit-activity btn btn-link-2" type="submit"><i class="fa fa-check-square-o"></i>Join</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.top-content -->
    </div>
    <!-- /#template-with-sidebar -->

@endsection

@section('scripts')
    <script type="text/javascript">
        /*var clipboardDemos = new Clipboard('[data-clipboard-copy]');

        clipboardDemos.on('success', function(e) {

            e.clearSelection();

            //console.info('Action:', e.action);
            //console.info('Text:', e.text);
            //console.info('Trigger:', e.trigger);

        });

        clipboardDemos.on('error', function(e) {

            //console.error('Action:', e.action);
            //console.error('Trigger:', e.trigger);

            showTooltip(e.trigger, fallbackMessage(e.action));

        });*/
    </script>
@endsection
