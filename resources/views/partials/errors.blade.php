<section>
    <div class="container-fluid">
        <div class="flash-alert">
            <div class="alert alert-{{ $flashAlert->type }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @if ($flashAlert->type == 'success')
                    <i class="fa fa-fw fa-check"></i>
                @else
                    <i class="fa fa-fw fa-exclamation-triangle"></i> 
                @endif
                <strong>{{ $flashAlert->type == 'success' ? ucfirst($flashAlert->type) : 'Error' }}</strong>: <small>{!! $flashAlert->content !!}</small>
            </div>        
        </div>
    </div>
</section>