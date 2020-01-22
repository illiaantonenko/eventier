@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right">
                    <a href="{{ url('/admin/news/create') }}"  class="btn btn-success btn-lg">Create news</a>
                </div>
                <h1>News</h1>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Created By</th>
                        <th>Created</th>
                        <th>Published</th>
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
                            <td> <a href="{{ url('/admin/news/change-status',['id'=> $news_one->id ]) }}"> @if($news_one->published == 1) <i class="text-success fa fa-check"></i> @else <i class="text-danger fa fa-close"></i> </a> @endif </td>
                            <td width="13%">
                                <a href="{{ url('/admin/news',['id'=> $news_one->id ]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/news/edit',['id'=> $news_one->id ]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ url('/admin/news',['id'=>$news_one->id]) }}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
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
