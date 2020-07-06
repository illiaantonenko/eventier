@extends('adminlte::page')

@section('title', __('Edit user'))
@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{__('Edit user')}}</h1>
                <form method="post" action="{{ route('admin.users.update',['id'=>$user->id]) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="control-label" for="firstname">{{__('Firstname')}}</label>
                        <input type="text" id="firstname" class="form-control" name="firstname"
                               value="{{$user->profile->firstname}}">
                        @if($errors->has('firstname'))
                            <span class="text-danger">{{$errors->get('firstname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="lastname">{{__('Lastname')}}</label>
                        <input type="text" id="lastname" class="form-control" name="lastname"
                               value="{{$user->profile->lastname}}">
                        @if($errors->has('lastname'))
                            <span class="text-danger">{{$errors->get('lastname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nickname">{{__('Nickname')}}</label>
                        <input type="text" id="nickname" class="form-control" name="nickname"
                               value="{{$user->profile->nickname}}">
                        @if($errors->has('nickname'))
                            <span class="text-danger">{{$errors->get('nickname')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email">{{__('Email')}}</label>
                        <input disabled type="text" id="email" class="form-control" name="email"
                               value="{{$user->email}}">
                        @if($errors->has('email'))
                            <span class="text-danger">{{$errors->get('email')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">{{__('Password')}}</label>
                        <input type="password" id="password" class="form-control" name="password">
                        @if($errors->has('password'))
                            <span class="text-danger">{{$errors->get('password')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password_confirmation">{{__('Password confirmation')}}</label>
                        <input type="password" id="password_confirmation" class="form-control"
                               name="password_confirmation">
                        @if($errors->has('password_confirmation'))
                            <span class="text-danger">{{$errors->get('password_confirmation')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="birthdate">{{__('Birth date')}}</label>
                        <input type="text" id="birthdate" class="form-control" name="birthdate"
                               value="{{ $user->birthday->date->toDateString() }}">
                        @if($errors->has('birthdate'))
                            <span class="text-danger">{{$errors->get('birthdate')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="role">{{__('Role')}}</label>
                        <select name="role" class="form-control">
                            <option value="" selected disabled>{{__('Select role')}} ...</option>
                            <option @if($user->role == 'user')  selected @endif value="user">{{__('User')}}</option>
                            <option @if($user->role == 'admin') selected
                                    @endif value="admin">{{__('Administrator')}}</option>
                        </select>
                        @if($errors->has('role'))
                            <span class="text-danger">{{$errors->get('role')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="role">{{__('Moderation')}}</label>
                        <select name="moderated" class="form-control">
                            <option value="" selected disabled>{{__('Select moderation')}} ...</option>
                            <option @if($user->moderated == 0)  selected
                                    @endif value="0">{{__('Not moderated')}}</option>
                            <option @if($user->moderated == 1)  selected @endif value="1">{{__('Moderated')}}</option>
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
