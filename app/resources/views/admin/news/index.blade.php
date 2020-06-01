<?php

use App\Models\News;

/**
 * @var News [] $news
 */
?>
@extends('adminlte::page')

@section('title', __('News'))

@section('content_header')
    <h1>{{__('News')}}</h1>
@endsection

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right form-group">
                    <a href="{{ url('/admin/news/create') }}" class="btn btn-success btn-lg">{{__('Create news')}}</a>
                </div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Created by')}}</th>
                        <th>{{__('Created')}}</th>
                        <th>{{__('Published')}}</th>
                        <th></th>
                    </tr>
                    @php $i = ($news->currentpage() - 1) * 20 @endphp
                    @foreach($news as $news_one)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $news_one->title }}</td>
                            <td>{{ $news_one->user->full_name }}</td>
                            <td>{{ $news_one->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.news.change_status',['id'=> $news_one->id ]) }}"> @if($news_one->published == 1)
                                        <i class="text-success fa fa-check"></i> @else <i
                                            class="text-danger fa fa-close"></i> </a> @endif </td>
                            <td class="action-column">
                                <a href="{{ route('admin.news.show',['id'=> $news_one->id ]) }}"
                                   class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.news.edit',['id'=> $news_one->id ]) }}"
                                   class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ route('admin.news.destroy',['id'=>$news_one->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$news->links()}}</div>
            </div>
        </div>
    </div>

@endsection
