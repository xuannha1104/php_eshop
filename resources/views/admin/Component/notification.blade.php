@if(session('notification'))
    @if(str_starts_with(session('notification'),'Error!'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ substr(session('notification'),6) }}</strong>
        </div>
    @else
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session('notification')}}</strong>
        </div>
    @endif
@endif
