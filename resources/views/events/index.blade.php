@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <div class="pagination-sm">{{ $events->links() }}</div>
                </div>
                <h1>{{ __('events') }}</h1>
                <div class="card-columns">
                    @foreach($events as $event)
                        <div class="card">
                            <div class="card-body">
                                <div class="text-left">
                                    <h5 style="display: inline-block">
                                        <a href="/user/profile/{{ $event->user->id }}" style="text-decoration: none; color:#1e1e1e">
                                            <strong>{{ $event->user->full_name }}:</strong>
                                        </a>
                                    </h5>
                                    {{ $event->title }}
                                    <br/>
                                    <div class="float-right">Date: {{  date('d-m-Y H:i',$event->start) }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">{{ $events->links() }}</div>
            </div>
        </div>
    </div>

@endsection
