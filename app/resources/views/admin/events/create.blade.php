@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{__('Create event')}}</h1>
                <form method="post" action="{{ url('/admin/events') }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="category">{{__('Category')}}</label>
                        <select name="category" class="form-control">
                            <option value="" selected disabled>{{__('Select category')}} ...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{$errors->get('user')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">{{__('Title')}}</label>
                        <input type="text" id="title" class="form-control"  name="title" value="{{old('title')}}">
                        @if($errors->has('title'))
                            <span class="text-danger">{{$errors->get('title')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="place">{{__('Place')}}</label>
                        <textarea name="place" id="place" class="form-control">{{old('place')}}</textarea>
                        @if($errors->has('place'))
                            <span class="text-danger">{{$errors->get('place')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description">{{__('Description')}}</label>
                        <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{$errors->get('description')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="start">{{__('Start time')}}</label>
                        <input type="datetime-local" id="start" class="form-control"  name="start" value="{{old('start')}}" placeholder="dd-mm-yyyy">
                        @if($errors->has('start'))
                            <span class="text-danger">{{$errors->get('start')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="end">{{__('End time')}}</label>
                        <input type="datetime-local" id="end" class="form-control"  name="end" value="{{old('end')}}" placeholder="dd-mm-yyyy">
                        @if($errors->has('end'))
                            <span class="text-danger">{{$errors->get('end')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="published">{{__('Published')}}</label>
                        <select name="published" class="form-control">
                            <option value="" selected disabled>{{__('Select status')}} ...</option>
                            <option value="0">{{__('Unpublished')}}</option>
                            <option value="1">{{__('Published')}}</option>
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
