<?php

use App\Models\Group;

/**
 * @var Group $group
 */
?>
@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span class="pull-right" style="margin-left: 10px">
                    <form method="post" action="{{ route('admin.course.destroy',['id'=>$group->id]) }}"
                          style="display:inline">
                                    @csrf
                        {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        {{__('Destroy')}}
                                    </button>
                                </form>
                </span>
                <span class="pull-right">
                    <a href="{{ route('admin.course.edit', $group->id) }}" class="btn btn-warning">{{__('Edit')}}</a>
                </span>
                <h1>{{$group->title}}</h1>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>Created: {{ $group->created_at->diffForHumans() }}</li>
                            <li>Updated: {{ $group->updated_at->diffForHumans() }}</li>

                        </ul>
                    </div>
                </div>
                <h3>
                    <b>{{__('Description')}}</b>
                </h3>
                <div class="box">
                    <div class="box-body">
                        {{ $group->description }}
                    </div>
                </div>
                @if($group->users)
                    <h3><b>{{__('User in group')}}</b></h3>
                    @foreach($group->users as $user)
                        <div class="info-box" style="margin-bottom: 15px">
                            <span class="info-box-icon">
                                <img src="">
                            </span>
                            <div class="info-box-content">
                                <p><b>{{ $user->full_name }}</b></p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
