@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('Calendar') }}</h1>
                <Calendar events="{{ $events }}" lang="{{ $locale }}"></Calendar>
            </div>
        </div>
    </div>

@endsection
