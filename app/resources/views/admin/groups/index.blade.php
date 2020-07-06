<?php

use App\Models\Group;

/**
 * @var Group [] $groups
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
                        <a href="{{ route('admin.group.create') }}"
                           class="btn btn-success btn-lg">{{__('Create group')}}</a>
                    </p>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>{{__('#')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Description')}}</th>
                        <th>{{__('Created')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($groups->currentpage() - 1) * 20 @endphp
                    @foreach($groups as $group)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $group->title }}</td>
                            <td>{{ $group->description }}</td>
                            <td>{{ $group->created_at }}</td>
                            <td class="action-column">
                                <a href="{{ route('admin.group.show',$group->id) }}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.group.edit',$group->id) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.group.destroy',$group->id) }}"
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
                <div class="pagination-lg">{{$groups->links()}}</div>
            </div>
        </div>
    </div>

@endsection
