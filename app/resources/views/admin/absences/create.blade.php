<?php

use App\Models\User;

/**
 * @var User [] $user
 */
?>
@extends('adminlte::page')

@section('title', __('Create absence'))

@section('content_header')
    <h1>{{__('Create absence')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('admin.absences.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="user">{{__('Author')}}</label>
                        <select name="user" class="form-control">
                            <option value="" selected disabled>{{__('Select author')}} ...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{$errors->get('user')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="reason">{{__('Reason')}}</label>
                        <input type="text" id="reason" class="form-control"  name="reason" value="{{old('reason')}}">
                        @if($errors->has('reason'))
                            <span class="text-danger">{{$errors->get('reason')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="datepicker">{{__('Date')}}</label>
                        <input type="text" id="datepicker" name="date" class="form-control" placeholder="dd-mm-yyyy"/>
                        @if($errors->has('date'))
                            <span class="text-danger">{{$errors->get('date')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Save absence')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
