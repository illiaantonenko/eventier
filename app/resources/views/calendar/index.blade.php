@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="{{ url('/absences/create') }}" class="btn btn-info btn-lg">{{ __('Declare the absence') }}</a>
                </div>
                <h1>{{ __('Calendar') }}</h1>
                <br>
                <Calendar events="{{ $events }}" lang="{{ $locale }}"></Calendar>
            </div>
        </div>
    </div>

@endsection
