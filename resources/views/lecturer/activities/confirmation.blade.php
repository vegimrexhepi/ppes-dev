@extends('layouts.app-lecturer')
@section('title', 'Confirmation')

@section('content')
	<div id="template-with-sidebar" class="lecturer-activities">
	    <!-- Top content -->
	    <div class="top-content lecturer-bg-color large-button">



	        <!-- KEY SECTION -->
            @include('partials.key-section')
				<div class="col-sm-6 col-sm-offset-3 col-lg-5 col-lg-offset-3 col-md-6">
					<div>
						<!-- Flash Messages -->
						@if (! is_null($flashAlert))
							@include('partials.errors', ['flashAlert' => $flashAlert])
						@endif
						<div class="form-box new-activity activity-confirmation">
							<div class="form-top">
								<div class="form-top-left">
									<h3>Confirmation</h3>
								</div>
							</div>
							<div class="form-bottom login-form mt-0">
								<h3><strong>{{ $activity->title }}</strong> has been created successfully!</h3><br>
								<p>Please copy the URL below to allow students to enroll in this activity:</p>
								<div class="copy-button">
									<input id="copytarget" type="text" value="{{ $activity->invitation_link.'/'.$activity->enrollment_key }}"><button class="btn btn-link-2" data-clipboard-copy="" data-clipboard-target="#copytarget"><i class="fa fa-clipboard"></i> Copy</button>
								</div><br>
								<p style="font-size: 20px;">Alternatively, provide students this key: <strong style="text-transform: uppercase;">{{ $activity->enrollment_key }}</strong></p>
								<a href="{{ route('lecturer.activities.index', Auth::id()) }}"><button class="submit-activity btn btn-link-2" type="submit">Return to Activities</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.top-content -->
	    </div>
	<!-- /.lecturer-activities -->
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
