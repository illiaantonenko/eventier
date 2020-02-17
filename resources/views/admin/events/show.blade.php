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
                            @if($event->category->name == 'Birthday')
                                <li>Date: @if($event->start){{ date('Y-m-d',$event->start) }} @endif</li>
                            @else
                                <li>Start: @if($event->start){{ date('Y-m-d h:i:s',$event->start) }} @endif</li>
                                <li>End: @if($event->end){{ date('Y-m-d h:i:s',$event->end) }} @endif</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <h3>
                    <b>Description</b>
                </h3>
                <div class="box">
                    <div class="box-body">
                        {{ $event->description }}
                    </div>
                </div>
                @if($event->category->name != 'Birthday')
                    <h3><b>Registered users</b></h3>
                    @foreach($eventRegistrations as $eventRegistration)
                        <div class="info-box" style="margin-bottom: 15px">
                            <span class="info-box-icon">
                                <img src="{{ $eventRegistration->user->getProfileImageSmall() }}">
                            </span>
                            <div class="info-box-content">
                                {{ $eventRegistration->user->full_name }}
                                <div class="pull-right">
                                    Registered: {{ $eventRegistration->created_at->diffForHumans() }}
                                </div>
                                @if($eventRegistration->came == 0 && $event->date < strtotime('today'))
                                    <br>
                                    <span class="text-danger">Missed!</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
