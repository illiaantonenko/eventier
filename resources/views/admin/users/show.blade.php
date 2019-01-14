@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>{{ __('Profile') }}</h2>
                <div class="card">
                    <div class="card-body" style="display: flex ">
                        <div>
                            <img src="{{ $user->profile->image->profile->url }}"/>
                        </div>
                        <div style="margin-left: 20px">
                            <div style="font-size: 20px; font-weight: 500">
                                {{ $user->profile->firstname}}
                                @if($user->profile->nickname)
                                    <div class="d-inline" style="font-size: smaller">
                                        {{ " (".$user->profile->nickname.") " }}
                                    </div>
                                @endif
                                {{ $user->profile->lastname }}
                            </div>
                            <div>
                                <strong>
                                    Birth date:
                                </strong>
                                {{ date('d-m-Y',$user->profile->birthdate) }}
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <h3>{{ __('Absences') }}</h3>
                @foreach($user->absence as $absence)
                    <div class="card" style="border: 1px solid #666666; border-radius: 5px; background-color: white; margin-bottom: 15px">
                        <div class="card-body" style="padding: 0 10px 20px">
                            <h6><strong>Date:{{ date('d-m-Y',$absence->date) }}</strong></h6>
                            <strong>{{ __('Reason') }}: </strong>{{ $absence->reason }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
