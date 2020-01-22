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
                                        <a href="{{ url('/user/profile',['id'=> $absence->user->id ])}}" style="text-decoration: none; color:#1e1e1e">
                                            <strong>{{ $absence->user->full_name }}:</strong>
                                        </a>
                                    </h5>
                                    {{ $absence->reason }}
                                    <br/>
                                    <div class="float-right">Date: {{  date('d-m-Y H:i',$absence->date) }}</div>
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
