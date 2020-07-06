<?php
use App\Models\Event;
/**
 * @var Event $event
 */
?>
@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{__('Create event')}}</h1>
                <form method="post" action="{{ url('/admin/events',['id'=> $event->id ]) }}">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="category">{{__('Category')}}</label>
                        <select name="category" class="form-control">
                            <option value="" selected disabled>{{__('Select category')}} ...</option>
                            @foreach($categories as $category)
                                <option @if($category->id == $event->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <span class="text-danger">{{$errors->get('category')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="user">{{__('Author')}}</label>
                        <select name="user" class="form-control">
                            <option value="" selected disabled>{{__('Select author')}} ...</option>
                            @foreach($users as $user)
                                <option @if($user->id == $event->user_id) selected @endif value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{$errors->get('user')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">Title</label>
                        <input type="text" id="title" class="form-control"  name="title" value="{{ $event->title }}">
                        @if($errors->has('title'))
                            <span class="text-danger">{{$errors->get('title')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description">{{__('Description')}}</label>
                        <textarea name="description" id="description" class="form-control">{{ $event->description }}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{$errors->get('description')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="start">{{__('Start time')}}</label>
                        <input type="text" id="start" class="form-control"  name="start" value="{{ $event->start->toDateString() }}" placeholder="dd-mm-yyyy">
                        @if($errors->has('start'))
                            <span class="text-danger">{{$errors->get('start')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="end">End time</label>
                        <input type="text" id="end" class="form-control"  name="end" value="{{ $event->end->toDateString() }}" placeholder="dd-mm-yyyy">
                        @if($errors->has('end'))
                            <span class="text-danger">{{$errors->get('end')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="published">{{__('Published')}}</label>
                        <select name="published" class="form-control">
                            <option value="" selected disabled>{{__('Select status')}} ...</option>
                            <option @if($event->published == 0) selected @endif value="0">{{__('Unpublished')}}</option>
                            <option @if($event->published == 1) selected @endif value="1">{{__('Published')}}</option>
                        </select>
                        @if($errors->has('published'))
                            <span class="text-danger">{{$errors->get('published')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Save event')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
