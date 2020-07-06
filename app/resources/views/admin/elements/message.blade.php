@if(Session::has('success'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div role="alert" class="alert alert-success">{{Session::get('success')}}</div>
            </div>
        </div>
    </div>
@endif

@if(Session::has('error'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div role="alert" class="alert alert-danger">{{Session::get('error')}}</div>
            </div>
        </div>
    </div>
@endif
