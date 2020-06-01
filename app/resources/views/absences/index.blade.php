@php
    use App\Models\Absence;
    /**
     * @var Absence $absence
    */
@endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <div class="pagination-sm">{{ $absences->links() }}</div>
                </div>
                <h1>{{ __('Absences') }}</h1>
                <div class="card-columns">
                    @foreach($absences as $absence)
                        <div class="card">
                            <div class="card-body">
                                <div class="text-left">
                                    <h5 style="display: inline-block">
                                        <a href="{{ route('user.profile',['id'=> $absence->user->id ])}}"
                                           style="text-decoration: none; color:#1e1e1e">
                                            <b>{{ $absence->user->full_name }}:</b>
                                        </a>
                                    </h5>
                                    {{ $absence->reason }}
                                    <br/>
                                    <div class="float-right">{{__("Date")}}: {{ $absence->date->toDateTimeString() }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">{{ $absences->links() }}</div>
            </div>
        </div>
    </div>

@endsection
