@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Edit {{$news->title}}</h1>
                <form method="post" action="/admin/news/{{$news->id}}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <img src="{{ $news->image->thumbnail->url }}"/>
                    <div class="form-group">
                        <label class="control-label" for="image">Image</label>
                        <input type="file" id="image" class="form-control" name="image">
                        @if($errors->has('image'))
                            <span class="text-danger">{{$errors->get('image')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{$news->title}}"/>
                    </div>
                    <div class="form-group">
                        <label for="user">Author</label>
                        <select name="user" class="form-control">
                            <option value="" disabled>Select author ...</option>
                            @foreach($users as $user)
                                <option @if($user->id == $news->user_id) selected @endif value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="important">Important</label>
                        <select name="important" class="form-control">
                            <option @if($news->important == 0) selected @endif value="0">Standard</option>
                            <option @if($news->important == 1) selected @endif value="1">Important</option>
                        </select>
                        @if($errors->has('important'))
                            <span class="text-danger">{{$errors->get('important')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="published">Published</label>
                        <select name="published" class="form-control">
                            <option @if($news->published == 0) selected @endif value="0">Unpublished</option>
                            <option @if($news->published == 1) selected @endif value="1">Published</option>
                        </select>
                        @if($errors->has('published'))
                            <span class="text-danger">{{$errors->get('published')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description">{{$news->description}}</textarea>
                        @if($errors->has('description'))
                            <span class="text-danger">{{$errors->get('description')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Update news</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
