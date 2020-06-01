<?php

use App\Models\Birthday;

/**
 * @var Birthday [] $birthdays
 */
?>
@extends('adminlte::page')

@section('title', __('Birthdays'))

@section('content_header')
    <h1>{{__('Birthdays')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right form-group">
                    <a href="{{ route('admin.birthdays.create') }}"
                       class="btn btn-success btn-lg">{{__('Create birthday')}}</a>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>{{__('User')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Created')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($birthdays->currentpage() - 1) * 20 @endphp
                    @foreach($birthdays as $birthday)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $birthday->user->full_name }}</td>
                            <td>{{ $birthday->date }}</td>
                            <td>{{ $birthday->created_at }}</td>
                            <td class="action-column">
                                <a href="{{ route('admin.birthdays.edit',['id'=> $birthday->id ]) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.birthdays.destroy',['id'=>$birthday->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$birthdays->links()}}</div>
            </div>
        </div>
    </div>

@endsection
