@extends('layouts.app')

@section('title', __('Dashboard'))
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>{{ __('Dashboard') }}</h1>
                <br/>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <div class="card-title">
                                <h2>{{__('News')}}</h2>
                            </div>
                            <div class="card-columns">
                                @foreach($news as $news_one)
                                    <div class="card">
                                        <a style="text-decoration: none; color:#1e1e1e"
                                           href="{{ url('/news',['id'=> $news_one->id ]) }}">
                                            <div class="card-body"
                                                 @if($news_one->important == 1) style="background-color: #b0d4f1"@endif>
                                                <div class="text-left" style="margin-bottom: 15px">
                                                    <img class="img-responsive img-sm"
                                                         src="{{ $news_one->image->small->url }}">
                                                </div>
                                                <div class="d-inline">
                                                    <h5>
                                                        <b>
                                                            @if(strlen($news_one->title) > 200)
                                                                {{ substr($news_one->title,0,strpos($news_one->title,' ', 195)).'...' }}
                                                            @else
                                                                {{ $news_one->title }}
                                                            @endif
                                                        </b>
                                                    </h5>
                                                    <br/>
                                                </div>
                                                <div class="d-flex">
                                                    @if(strlen($news_one->description) > 300)
                                                        {{ substr($news_one->description,0,strpos($news_one->description,' ', 295)).'...' }}
                                                    @else
                                                        {{ $news_one->description }}
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <br/>
                                @endforeach
                                <div class="float-right">
                                    <a href="{{ url('/news') }}">{{__('See all')}}...</a>
                                </div>
                            </div>
                            <h2>{{__('Absences')}}</h2>
                            <div class="card-columns">
                                @foreach($absences as $absence)
                                    <div class="card">
                                        <div class="card-body" style="background-color: #eaea00">
                                            <div class="text-left">
                                                <h5 class="d-inline">
                                                    <a href="{{ url('/user/profile',['id'=> $absence->user->id ]) }}"
                                                       style="text-decoration: none; color:#1e1e1e">
                                                        <b>{{ $absence->user->full_name }}:</b>
                                                    </a>
                                                </h5>
                                                {{ $absence->reason }}
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                                <div class="float-right">
                                    <a href="{{ url('/absences') }}">{{__('See all')}}...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
