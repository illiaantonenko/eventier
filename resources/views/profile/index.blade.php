@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ __('Profile') }}</h2>
                <div class="card">
                    <div class="card-body" style="display: flex ">
                        <div >
                            <img src="{{ $profile->image->profile->url }}"/>
                        </div>
                        <div style="margin-left: 20px">
                            <div style="font-size: 20px; font-weight: 500">
                                {{ $profile->firstname." "}}
                                @if($profile->nickname)
                                    <div class="d-inline" style="font-size: smaller">
                                        {{ "(".$profile->nickname.")" }}
                                    </div>
                                @endif
                                {{ " ".$profile->lastname }}
                            </div>
                            <div>
                                <strong>
                                    {{__('Birth date')}}:
                                </strong>
                                @if(!$profile->hideyear)
                                    {{ date('d-m-Y',$profile->birthdate) }}
                                @else
                                    {{ date('d.m',$profile->birthdate) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <h3>{{ __('Absences') }}</h3>
                @foreach($absences as $absence)
                    <div class="card" style="margin-bottom: 15px">
                        <div class="card-body">
                            <h6><strong>{{__('Date')}}:{{ date('d-m-Y',$absence->date) }}</strong></h6>
                            <strong>{{ __('Reason') }}: </strong>{{ $absence->reason }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
