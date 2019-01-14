@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>Absence</h2>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>Author: {{ $absence->user->full_name }}</li>
                            <li>Created: {{ $absence->created_at->diffForHumans() }}</li>
                            <li>Updated: {{ $absence->updated_at->diffForHumans() }}</li>
                            <li>Reason: {{ $absence->reason }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
