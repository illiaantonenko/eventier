<?php

use App\Models\Event;
use A\SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * @var Event $event
 */
?>
@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span class="pull-right" style="margin-left: 10px">
                    <form method="post" action="{{ route('admin.events.destroy', $event->id) }}"
                          style="display:inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            {{__('Destroy')}}
                        </button>
                    </form>
                </span>
                <span class="pull-right" style="margin-left: 10px">
                    <form method="post" action="{{ route('admin.events.refresh_qrc',$event->id) }}"
                          style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-info">
                            {{__('Refresh QRC')}}
                        </button>
                    </form>
                </span>
                <span class="pull-right">
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">{{__('Edit')}}</a>
                </span>
                <h1>{{$event->title}}</h1>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>{{__('Author')}}: {{ $event->user->full_name }}</li>
                            <li>{{__('Created')}}: {{ $event->created_at->diffForHumans() }}</li>
                            <li>{{__('Updated')}}: {{ $event->updated_at->diffForHumans() }}</li>
                            @if($event->category->name == 'Birthday')
                                <li>{{__('Date')}}: @if($event->start){{ $event->start->toDateString() }} @endif</li>
                            @else
                                <li>{{__('Start time')}}: @if($event->start){{ $event->start->toDateString() }} @endif</li>
                                <li>{{__('End time')}}: @if($event->end){{ $event->end->toDateString() }} @endif</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <h3>
                    <b>{{__('Description')}}</b>
                </h3>
                <div class="box">
                    <div class="box-body">
                        {{ $event->description }}
                    </div>
                </div>
                <h3>
                    <b>{{__('QRC')}}</b>
                </h3>
                <div class="box">
                    <div class="box-body">
                        <img src="
                            data:image/jpeg;base64,{{base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate(route('events.confirm', ['hash' => $event->qrc])))}}
                            " alt="">
                    </div>
                </div>
                @if($event->category->name != 'Birthday')
                    <h3><b>{{__('Registered users')}}</b></h3>
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
                                    <span class="text-danger">{{__('Missed')}}!</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
