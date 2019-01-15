@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-bottom: 20px">
                    <div class="card-header">
                        {{ $event->title }}
                        <div class="float-right">
                            <strong>Author:</strong> {{ $event->user->full_name }}
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $event->description }}
                    </div>
                </div>
                @if($event->date > strtotime('today'))
                <div style="margin-bottom: 20px;">
                    <a href="/events/{{ $event->id }}/register" class="btn btn-info btn-lg">Register on event</a>
                </div>
                @endif
                @foreach($eventRegistrations as $eventRegistration)

                    <div class="card" style="margin-bottom: 15px">
                        <div class="card-body">
                            {{ $eventRegistration->user->full_name }}
                            <div class="float-right">
                                Registered: {{ $eventRegistration->created_at->diffForHumans() }}
                            </div>
                            @if($eventRegistration->came == 0 && $event->date < strtotime('today'))
                                <span class="text-danger">Missed!</span>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
