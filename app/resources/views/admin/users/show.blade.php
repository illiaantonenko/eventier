@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span class="pull-right" style="margin-left: 10px">
                    <form method="post" action="{{ route('admin.events.destroy',['id'=>$event->id]) }}"
                          style="display:inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            {{__('Destroy')}}
                        </button>
                    </form>
                </span>
                <span class="pull-right">
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning">{{__('Edit')}}</a>
                </span>
                <h1>{{ __('Profile') }}</h1>
                <div class="card">
                    <div class="card-body" style="display: flex;">
                        <div>
                            <img src="{{ $user->getProfileImage() }}"/>
                        </div>
                        <div style="margin-left: 20px">
                            <div class="user-name">
                                {{ $user->profile->firstname}}
                                @if($user->profile->nickname)
                                    <div class="d-inline" style="font-size: smaller">
                                        {{ " (".$user->profile->nickname.") " }}
                                    </div>
                                @endif
                                {{ $user->profile->lastname }}
                            </div>
                            <div>
                                <b>
                                    Birth date:
                                </b>
                                {{ $user->birthday->date->toDateString() }}
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <h3>{{ __('Absences') }}</h3>
                @foreach($user->absences as $absence)
                    <div class="card" style="border: 1px solid #666666; border-radius: 5px; background-color: white; margin-bottom: 15px">
                        <div class="card-body" style="padding: 0 10px 20px">
                            <h6><b>Date: {{ $absence->date->toDateString() }}</b></h6>
                            <b>{{ __('Reason') }}: </b>{{ $absence->reason }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
