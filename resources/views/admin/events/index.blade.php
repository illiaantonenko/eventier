<?php

use App\Models\Event;

/**
 * @var Event [] $events
 */
?>
@extends('adminlte::page')

@section('title', __('Events'))

@section('content_header')
    <h1>{{__('Events')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="navigation">
                    <div class="pull-left">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-info btn-lg">{{__('All events')}}</a>
                        <a href="{{ route('admin.events.index',[ 'published' => 1 ]) }}" class="btn btn-info btn-lg">
                            {{__('New events')}}
                        </a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('admin.events.create') }}"
                           class="btn btn-success btn-lg">{{__('Create event')}}</a>
                    </div>
                </div>
                <br>
                <table class="table table-striped table-bordered" style="margin-top: 50px">
                    <tr>
                        <th>{{__('#')}}</th>
                        <th>{{__('User')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Start')}}</th>
                        <th>{{__('End')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Published')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($events->currentpage() - 1) * 20 @endphp
                    @foreach($events as $event)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $event->user->full_name }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>@if($event->start) {{ $event->start }} @else --- @endif</td>
                            <td>@if($event->end) {{ $event->end }} @else --- @endif</td>
                            <td>{{ $event->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.events.change_status',['id'=>$event->id]) }}"> @if($event->published == 1)
                                        <i class="text-success fa fa-check"></i> @else <i
                                            class="text-danger fa fa-close"></i> </a> @endif </td>
                            <td class="action-column">
                                <a href="{{ route('admin.events.show',['id'=>$event->id]) }}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.events.edit',['id'=>$event->id]) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.events.destroy',['id'=>$event->id]) }}"
                                      style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$events->links()}}</div>
            </div>
        </div>
    </div>

@endsection
