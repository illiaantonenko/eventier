<?php

use App\Models\Event;

/**
 * @var Event [] $events
 * @var string $locale
 */
?>
@extends('adminlte::page')

@section('title', __('Calendar'))

@section('content_header')
    <h1>{{__('Calendar')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <Calendar events="{{ $events }}" lang="{{ $locale }}"></Calendar>
            </div>
        </div>
    </div>

@endsection
