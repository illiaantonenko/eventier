@extends('layouts.app')

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
                                <h2>News</h2>
                            </div>
                            <div class="card-columns">
                                @foreach($news as $news_one)
                                    <div class="card">
                                        <a style="text-decoration: none; color:#1e1e1e" href="/dashboard/news/{{ $news_one->id }}">
                                            <div class="card-body" @if($news_one->important == 1) style="background-color: #b0d4f1"@endif>
                                                <div class="text-left">
                                                    <h5><strong>{{ $news_one->title }}</strong></h5>
                                                    <br/>
                                                    {{ $news_one->description }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <br>
                                @endforeach
                                <div class="float-right">
                                    <a href="/dashboard/news">See all news</a>
                                </div>
                            </div>
                            <h2>Absences</h2>
                            <div class="card-columns">
                                @foreach($absences as $absence)
                                    <div class="card">
                                        <div class="card-body" style="background-color: #eaea00">
                                            <div class="text-left">
                                                <h5 class="d-inline">
                                                    <a href="/user/profile/{{ $absence->user->id }}" style="text-decoration: none; color:#1e1e1e">
                                                        <strong>{{ $absence->user->full_name }}:</strong>
                                                    </a>
                                                </h5>
                                                {{ $absence->reason }}
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                                <div class="float-right">
                                    <a href="/dashboard/absences">See all absences</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
