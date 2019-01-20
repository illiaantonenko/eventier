@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <div class="pagination-sm">{{ $events->links() }}</div>
                </div>
                <h1>{{ __('Events') }}</h1>
                <div class="card-columns">
                    @foreach($events as $event)
                        <div class="card"
                             style="background-color: {{ $event->category->color }}; color: {{ $event->category->textColor }}">
                            <a href="/events/{{ $event->id }}" style="text-decoration: none; color: unset">
                                <div class="card-header">
                                    {{ $event->title }}
                                </div>
                                <div class="card-body">
                                    <div class="text-left">
                                        {{ $event->description }}
                                        <div class="float-right" style="margin-top: 15px">
                                            Date: {{  date('d-m-Y H:i',$event->start) }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">{{ $events->links() }}</div>
            </div>
        </div>
    </div>

@endsection
