@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Create birthday celebration</h1>
                <form method="post" action="/admin/birthdays">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="user_id">Birthday boy/girl</label>
                        <select name="user_id" class="form-control">
                            <option value="" selected disabled>Select birthday boy/girl ...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user_id'))
                            <span class="text-danger">{{$errors->get('user_id')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">Date</label>
                        <input type="text" id="date" name="date" class="form-control" placeholder="dd-mm-yyyy"/>
                        @if($errors->has('date'))
                            <span class="text-danger">{{$errors->get('date')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="hideyear">Published</label>
                        <input type="hidden" name="published" value="0"/>
                        <input type="checkbox" name="published" value="1"/>
                        @if($errors->has('published'))
                            <span class="text-danger">{{$errors->get('published')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Save birthday</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
