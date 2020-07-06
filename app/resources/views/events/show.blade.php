@php
    /**
     * @var \App\Models\Event $event
     * @var \App\Models\EventRegistration[] $eventRegistrations
     */
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card" style="margin-bottom: 20px">
                    <div class="card-header">
                        {{ $event->title }}
                        <div class="float-right">
                            <b>{{__('Author')}}:</b> {{ $event->user->full_name }}
                        </div>
                    </div>
                    <div class="card-body">
                        @if($event->place) <p><b>{{ __('Place') }}:</b> {{ $event->place }}</p>@endif
                        @if($event->description)  <p>{{ $event->description }}</p> @endif
                    </div>
                </div>
                {{--                @if($event->start->timestamp > strtotime('today'))--}}
                {{--                    <div style="margin-bottom: 20px;">--}}
                {{--                        <a href="{{ url('/events/register',['id'=>  $event->id  ]) }}"--}}
                {{--                           class="btn btn-info btn-lg">{{__('Register')}}</a>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                @foreach($eventRegistrations as $eventRegistration)
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-thumbnail img-responsive img-fluid float-left"
                                     src="{{ $eventRegistration->user->getProfileImageXSmall() }}"/>
                                <div class="float-left" style="padding: inherit;">
                                    {{ $eventRegistration->user->full_name }}
                                </div>
                                <div class="float-right">
                                    {{--TODO: change diffForHumans to localized version--}}
                                    {{__('Registered')}}: {{ $eventRegistration->created_at->toDateString() }}
                                </div>
                                @if($eventRegistration->came == 0 && $event->date < strtotime('today'))
                                    <span class="text-danger" style="padding: inherit;">{{__('Missed')}}!</span>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
