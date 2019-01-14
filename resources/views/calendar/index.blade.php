@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <a href="/dashboard/absences/create" class="btn btn-info btn-lg">{{ __('Create absence') }}</a>
                </div>
                <h1>{{ __('Calendar') }}</h1>
                <br>
                <full-calendar :config="config" :events="{{ $events }}"></full-calendar>
            </div>
        </div>
    </div>

@endsection
