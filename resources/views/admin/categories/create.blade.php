@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Create event</h1>
                <form method="post" action="/admin/categories">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="name">Category name</label>
                        <input type="text" id="name" class="form-control"  name="name" value="{{old('name')}}">
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->get('name')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-2 col-form-label" for="color">Background color</label>
                        <div class="col-10">
                            <input type="color" name="color" id="color" style="width: 90px; height: 90px">
                        </div>
                        <p class="help-block"></p>
                        @if($errors->has('color'))
                            <p class="help-block">
                                {{ $errors->first('color') }}
                            </p>
                        @endif
                    </div>
                     <div class="form-group">
                        <label class="col-2 col-form-label" for="textColor">Text color</label>
                         <div class="col-10">
                             <input type="color" name="textColor" id="textColor" style="width: 90px; height: 90px">
                         </div>
                        <p class="help-block"></p>
                        @if($errors->has('textColor'))
                            <p class="help-block">
                                {{ $errors->first('textColor') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Save category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
