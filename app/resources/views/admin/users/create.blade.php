@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{__('Create user')}}</h1>
                <form method="post" action="{{ url('/admin/users') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="image">{{__('Image')}}</label>
                        <input type="file" id="image" class="form-control" name="image" lang="en">
                        @if($errors->has('image'))
                            <span class="text-danger">{{$errors->get('image')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="firstname">{{__('Firstname')}}</label>
                        <input type="text" id="firstname" class="form-control" name="firstname"
                               value="{{old('firstname')}}">
                        @if($errors->has('firstname'))
                            <span class="text-danger">{{$errors->get('firstname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="lastname">{{__('Lastname')}}</label>
                        <input type="text" id="lastname" class="form-control" name="lastname"
                               value="{{old('lastname')}}">
                        @if($errors->has('lastname'))
                            <span class="text-danger">{{$errors->get('lastname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="middlename">{{__('Middlename')}}</label>
                        <input type="text" id="middlename" class="form-control" name="middlename"
                               value="{{old('middlename')}}">
                        @if($errors->has('middlename'))
                            <span class="text-danger">{{$errors->get('middlename')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nickname">{{__('Nickname')}}</label>
                        <input type="text" id="nickname" class="form-control" name="nickname"
                               value="{{old('nickname')}}">
                        @if($errors->has('nickname'))
                            <span class="text-danger">{{$errors->get('nickname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="birthdate">{{__('Birthdate')}}</label>
                        <input type="text" id="birthdate" class="form-control" name="birthdate"
                               value="{{old('birthdate')}}" placeholder="dd-mm-yyyy">
                        @if($errors->has('birthdate'))
                            <span class="text-danger">{{$errors->get('birthdate')[0]}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="hideyear">{{__('Hide year')}}</label>
                        <input type="hidden" name="hideyear" value="0"/>
                        <input type="checkbox" name="hideyear" value="1"/>
                        @if($errors->has('hideyear'))
                            <span class="text-danger">{{$errors->get('hideyear')[0]}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="email">{{__('E-mail')}}</label>
                        <input type="text" id="email" class="form-control" name="email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <span class="text-danger">{{$errors->get('email')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password_confirmation">{{__('Password')}}</label>
                        <input type="password" id="password" class="form-control" name="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{$errors->get('password')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password_confirmation">{{__('Password confirmation')}}</label>
                        <input type="password" id="password_confirmation" class="form-control"
                               name="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="role">{{__('Role')}}</label>
                        <select name="role" class="form-control">
                            <option value="" selected disabled>Select role ...</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @if($errors->has('role'))
                            <span class="text-danger">{{$errors->get('role')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="role">{{__('Moderation')}}</label>
                        <select name="moderated" class="form-control">
                            <option value="" selected disabled>{{__('Select moderation')}} ...</option>
                            <option value="0">Not moderated</option>
                            <option value="1">Moderated</option>
                        </select>
                        @if($errors->has('moderated'))
                            <span class="text-danger">{{$errors->get('moderated')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Save user')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
