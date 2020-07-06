<?php

use App\Models\Course;

/**
 * @var Course $course
 */
?>
@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span class="pull-right" style="margin-left: 10px">
                    <form method="post" action="{{ route('admin.course.destroy',['id'=>$course->id]) }}"
                          style="display:inline">
                                    @csrf
                        {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">
                                        {{__('Destroy')}}
                                    </button>
                                </form>
                </span>
                <span class="pull-right">
                    <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-warning">{{__('Edit')}}</a>
                </span>
                <h1>{{$course->title}}</h1>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>Author: {{ $course->user->full_name }}</li>
                            <li>Created: {{ $course->created_at->diffForHumans() }}</li>
                            <li>Updated: {{ $course->updated_at->diffForHumans() }}</li>

                        </ul>
                    </div>
                </div>
                <h3>
                    <b>{{__('Description')}}</b>
                </h3>
                <div class="box">
                    <div class="box-body">
                        {{ $course->description }}
                    </div>
                </div>
                @if($course->groups)
                    <h3><b>Added groups</b></h3>
                    @foreach($course->groups as $group)
                        <div class="info-box" style="margin-bottom: 15px">
                            <span class="info-box-icon">
                                <img src="">
                            </span>
                            <div class="info-box-content">
                                <p><b>{{ $group->title }}</b></p>
                                <p>{{ $group->description }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
