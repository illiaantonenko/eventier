@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>{{ __('News') }}</h1>
                <div class="pagination-sm">{{ $news->links() }}</div>
                @foreach($news as $news_one)
                    <a href="/news/{{$news_one->id}}" style="text-decoration: none; color:#1e1e1e;">
                        <div class="card" style="margin-bottom: 15px">
                            <div class="card-body">
                                <h4><strong> {{ $news_one->title }}</strong></h4>
                                {{ $news_one->description }}
                            </div>
                        </div>
                    </a>
                @endforeach
                <br/>
                <div class="pagination-sm">{{ $news->links() }}</div>
            </div>
        </div>
    </div>

@endsection
