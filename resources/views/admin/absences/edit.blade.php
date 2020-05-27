<?php

use App\Models\Absence;

/**
 * @var Absence $absence
 */
?>
@extends('adminlte::page')

@section('title', __('Edit absence'))

@section('content_header')
    <h1>{{__('Edit absence')}}</h1>
@endsection

@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('admin.absences.update',['id'=>$absence->id]) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="user">{{__('Author')}}</label>
                        <select name="user" class="form-control">
                            <option value="" disabled>{{__('Select author')}} ...</option>
                            @foreach($users as $user)
                                <option @if($user->id == $absence->user_id) selected @endif value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="reason">{{__('Reason')}}</label>
                        <input type="text" id="reason" class="form-control"  name="reason" value="{{ $absence->reason }}">
                        @if($errors->has('reason'))
                            <span class="text-danger">{{$errors->get('reason')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">{{__('Date')}}</label>
                        <input type="text" id="date" name="date" class="form-control" value="{{ $absence->date->toDateString() }}"/>
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
