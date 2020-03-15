@extends('layouts.app-student')
@section('title', 'Enroll Success')

@section('content')
    <div id="template-with-sidebar" class="lecturer-activities">
        <div class="top-content">

            <div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 criteria-top col-md-6">
                <div>
                    <div class="form-box new-activity activity-confirmation">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>SUCCESS!</h3>
                            </div>
                        </div>
                        <div class="form-bottom login-form">
                            <h3>You have successfully enrolled to "Activity Title"</h3><br>
                            <p>You will make a presentation for this activity as scheduled by the lecturer.</p><br>
                            <button class="submit-activity btn btn-link-2" type="submit"><i class="fa fa-arrow-circle-o-left"></i> Return to Activities</button>
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
    <script src="{{ asset('js/libs/clipboard.js') }}"></script>
    <script src="{{ asset('js/libs/classie.js') }}"></script>
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
@stop
