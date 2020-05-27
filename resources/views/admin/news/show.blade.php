@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>{{$news->title}}</h1>
                <div class="panel">
                    <div class="panel-body">
                        <ul>
                            <li>Author: {{ $news->user->full_name }}</li>
                            <li>Created: {{ $news->created_at->diffForHumans() }}</li>
                            <li>Updated: {{ $news->updated_at->diffForHumans() }}</li>
                            <li>@if($news->important == 1) Important @else Standard @endif news</li>
                            <li>@if($news->published == 1) Published @else Unpublished @endif</li>
                        </ul>
                    </div>
                </div>
                <div class="content">
                    <div class="pull-right">
                        <img src="{{ $news->image->profile->url }}">
                    </div>
                    {{ $news->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
