<?php

use App\Models\Birthday;

/**
 * @var Birthday $birthday
 */
?>
@extends('adminlte::page')

@section('title', __('Edit birthday'))

@section('content_header')
    <h1>{{__('Create birthday')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{route('admin.birthdays.store')}}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="user_id">{{__('Birthday boy/girl')}}</label>
                        <select name="user_id" class="form-control">
                            <option value="" selected disabled>{{__('Select birthday boy/girl')}} ...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user_id'))
                            <span class="text-danger">{{$errors->get('user_id')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">{{__('Date')}}</label>
                        <input type="text" id="date" name="date" class="form-control" placeholder="dd-mm-yyyy"/>
                        @if($errors->has('date'))
                            <span class="text-danger">{{$errors->get('date')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="published">{{__('Published')}}</label>
                        <input type="hidden" name="published" value="0"/>
                        <input type="checkbox" name="published" id="published" value="1"/>
                        @if($errors->has('published'))
                            <span class="text-danger">{{$errors->get('published')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Save birthday')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
