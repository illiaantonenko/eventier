@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right">
                    <a href="{{ url('/admin/birthdays/create') }}"  class="btn btn-success btn-lg">Create birthday</a>
                </div>
                <h1>{{ __('Birthdays') }}</h1>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                    @php $i = ($birthdays->currentpage() - 1) * 20 @endphp
                    @foreach($birthdays as $birthday)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $birthday->user->full_name }}</td>
                            <td>{{ date('Y-m-d',$birthday->date) }}</td>
                            <td>{{ $birthday->created_at }}</td>
                            <td width="13%">
                                <a href="{{ url('/admin/birthdays',['id'=> $birthday->id ]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/admin/birthdays/edit',['id'=> $birthday->id ]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="{{ url('/admin/birthdays',['id'=>$birthday->id]) }}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$birthdays->links()}}</div>
            </div>
        </div>
    </div>

@endsection
