@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif


@if(session('success'))
    <div style="position:absolute;z-index:2;top:60px;right:20px;" class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif