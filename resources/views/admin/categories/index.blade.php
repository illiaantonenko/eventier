@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Categories</h1>
                <div class="navigation">
                    <div class="pull-right">
                        <a href="{{ url('/admin/categories/create') }}"  class="btn btn-success btn-lg">Create new category</a>
                    </div>
                </div>
                <br>
                <table class="table table-striped table-bordered" style="margin-top: 50px">
                    <tr>
                        <th>#</th>
                        <th>Category name</th>
                        <th>Text color</th>
                        <th>Background color</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                    @php $i = ($categories->currentpage() - 1) * 20 @endphp
                    @foreach($categories as $category)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="20%" style="background-color: {{ $category->textColor }}"></td>
                            <td width="20%" style="background-color: {{ $category->color }}"></td>
                            <td>{{ $category->created_at }}</td>
                            <td width="15%">
                                <a href="{{ url('/admin/categories',['id'=> $category->id ]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/categories/edit',['id'=> $category->id ]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ url('/admin/categories',['id'=>$category->id]) }}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
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
