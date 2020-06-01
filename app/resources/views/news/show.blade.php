@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $news->title }}</h1>
                <div class="card">
                    <div class="card-body">
                        {{ $news->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
