<?php

use App\Models\Absence;

/**
 * @var Absence [] $absences
 */
?>
@extends('adminlte::page')

@section('title', __('Absences'))

@section('content_header')
    <h1>{{__('Absences')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right form-group">
                    <a href="{{ route('admin.absences.create') }}"
                       class="btn btn-success btn-lg">{{__('Create absence')}}</a>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>{{__('User')}}</th>
                        <th>{{__('Reason')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Created')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($absences->currentpage() - 1) * 20 @endphp
                    @foreach($absences as $absence)
                        @php  $i++ @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $absence->user->full_name }}</td>
                            <td>{{ $absence->reason }}</td>
                            <td>{{ $absence->date->toDateString() }}</td>
                            <td>{{ $absence->created_at }}</td>
                            <td class="action-column">
                                <a href="{{ route('admin.absences.show',['id'=> $absence->id ]) }}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.absences.edit',['id'=> $absence->id ]) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.absences.destroy',['id'=>$absence->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$absences->links()}}</div>
            </div>
        </div>
    </div>

@endsection
