@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{$event->title}}</h1>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>Author: {{ $event->user->full_name }}</li>
                            <li>Created: {{ $event->created_at->diffForHumans() }}</li>
                            <li>Updated: {{ $event->updated_at->diffForHumans() }}</li>
                            <li>Start: @if($event->start){{ date('Y-m-d h:i:s',$event->start) }} @endif</li>
                            <li>End: @if($event->end){{ date('Y-m-d h:i:s',$event->end) }} @endif</li>
                        </ul>
                    </div>
                </div>
                <div class="content">
                    {{ $event->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
