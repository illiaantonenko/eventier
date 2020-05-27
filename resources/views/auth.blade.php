@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <auth url="{{ $redirect_url }}"></auth>
                </div>
            </div>
        </div>
    </div>

@endsection
