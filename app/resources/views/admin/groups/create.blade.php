@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Create event</h1>
                <form method="post" action="{{ url('/admin/events') }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="category">Category</label>
                        <select name="category" class="form-control">
                            <option value="" selected disabled>Select category ...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                            <span class="text-danger">{{$errors->get('category')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="user">Author</label>
                        <select name="user" class="form-control">
                            <option value="" selected disabled>Select author ...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{$errors->get('user')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">Title</label>
                        <input type="text" id="title" class="form-control"  name="title" value="{{old('title')}}">
                        @if($errors->has('title'))
                            <span class="text-danger">{{$errors->get('title')[0]}}</span>
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
                        <label class="control-label" for="start">Start time</label>
                        <input type="text" id="start" class="form-control"  name="start" value="{{old('start')}}" placeholder="dd-mm-yyyy">
                        @if($errors->has('start'))
                            <span class="text-danger">{{$errors->get('start')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="end">End time</label>
                        <input type="text" id="end" class="form-control"  name="end" value="{{old('end')}}" placeholder="dd-mm-yyyy">
                        @if($errors->has('end'))
                            <span class="text-danger">{{$errors->get('end')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="published">Published</label>
                        <select name="published" class="form-control">
                            <option value="" selected disabled>Select status ...</option>
                            <option value="0">Unpublished</option>
                            <option value="1">Published</option>
                        </select>
                        @if($errors->has('published'))
                            <span class="text-danger">{{$errors->get('published')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Save event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
