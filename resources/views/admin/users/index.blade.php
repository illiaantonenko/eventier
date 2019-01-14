@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right">
                    <a href="/admin/users/create"  class="btn btn-success btn-lg">Create user</a>
                </div>
                <h1>Users</h1>
                <br>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Birth date</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ date('Y-m-d', $user->profile->birthdate) }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td width="13%">
                                <a href="/admin/users/{{$user->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                @if($user->id != auth()->user()->id)
                                    <a href="/admin/users/{{$user->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="/admin/users/{{$user->id}}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$users->links()}}</div>
            </div>
        </div>
    </div>

@endsection
