<?php

use App\Models\Course;

/**
 * @var Course [] $courses
 */
?>
@extends('adminlte::page')

@section('title', __('Courses'))

@section('content_header')
    <h1>{{__('Courses')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="navigation">
                    <p class="pull-right">
                        <a href="{{ route('admin.course.create') }}"
                           class="btn btn-success btn-lg">{{__('Create course')}}</a>
                    </p>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>{{__('#')}}</th>
                        <th>{{__('Author')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Created')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($courses->currentpage() - 1) * 20 @endphp
                    @foreach($courses as $course)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $course->user->full_name }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ $course->created_at }}</td>
                            <td class="action-column">
                                <a href="{{ route('admin.course.show',$course->id) }}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.course.edit',$course->id) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.course.destroy',$course->id) }}"
                                      style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$courses->links()}}</div>
            </div>
        </div>
    </div>

@endsection
