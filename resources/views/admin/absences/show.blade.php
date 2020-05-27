<?php

use App\Models\Absence;

/**
 * @var Absence $absence
 */
?>
@extends('adminlte::page')

@section('title', __('Absence'))

@section('content_header')
    <h1>{{__('Absence')}}</h1>
@endsection

@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>{{__('Author')}}: {{ $absence->user->full_name }}</li>
                            <li>{{__('Created')}}: {{ $absence->created_at->diffForHumans() }}</li>
                            <li>{{__('Updated')}}: {{ $absence->updated_at->diffForHumans() }}</li>
                            <li>{{__('Reason')}}: {{ $absence->reason }}</li>
                            <li>{{__('Date')}}: {{ $absence->date->toDateString() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
