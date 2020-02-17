<?php

use App\Models\EventCategory;

/**
 * @var EventCategory [] $categories
 */
?>
@extends('adminlte::page')

@section('title', __('Categories'))

@section('content_header')
    <h1>{{__('Categories')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="navigation">
                    <div class="pull-right form-group">
                        <a href="{{ route('admin.events.categories.create') }}"
                           class="btn btn-success btn-lg">{{__('Create category')}}</a>
                    </div>
                </div>
                <br>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>{{__('EventCategory name')}}</th>
                        <th>{{__('Text color')}}</th>
                        <th>{{__('Background color')}}</th>
                        <th>{{__('Created')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($categories->currentpage() - 1) * 20 @endphp
                    @foreach($categories as $category)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->name }}</td>
                            <td style="width: 20%; background-color: {{ $category->textColor }}"></td>
                            <td style="width: 20%; background-color: {{ $category->color }}"></td>
                            <td>{{ $category->created_at }}</td>
                            <td class="action-column">
                                <a href="{{ route('admin.events.categories.edit',['id'=> $category->id ]) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post"
                                      action="{{ route('admin.events.categories.destroy',['id'=>$category->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$categories->links()}}</div>
            </div>
        </div>
    </div>

@endsection
