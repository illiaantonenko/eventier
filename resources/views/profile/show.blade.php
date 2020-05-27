@php
    use App\Models\Absence;
    use App\Models\Profile;

        /**
         * @var Profile $profile
         * @var Absence[] $absences
        */

@endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="headline">
                    <h2>{{ __('Profile') }}</h2>
                    <a href="{{ route('user.profile.edit',['id'=>auth()->id()]) }}"
                       class="btn btn-success btn-lg">{{ __('Edit data') }}</a>
                </div>
                <div class="card">
                    <div class="card-body" style="display: flex ">
                        <div>
                            <img src="{{ $profile->image->profile->url }}" alt="profile image"/>
                        </div>
                        <div style="margin-left: 20px">
                            <div class="user-name">
                                {{ $profile->firstname." "}}
                                @if($profile->nickname)
                                    <span style="font-size: smaller">
                                        {{ "(".$profile->nickname.")" }}
                                    </span>
                                @endif
                                {{ " ".$profile->lastname }}
                            </div>
                            <span>
                                <b> {{__('Birth date')}}: </b> {{ $profile->user->birthday->date->toDateString() }}
                            </span>
                        </div>
                    </div>
                </div>
                <br/>
                <h3>{{ __('Absences') }}</h3>
                @foreach($profile->user->absences as $absence)
                    <div class="form-group">
                        <div class="card" style="margin-bottom: 15px">
                            <div class="card-body">
                                <h6><b>{{__('Date')}}: {{ $absence->date->toDateString() }}</b></h6>
                                <b>{{ __('Reason') }}: </b>{{ $absence->reason }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
