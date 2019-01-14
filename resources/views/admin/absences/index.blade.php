@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right">
                    <a href="/admin/absences/create"  class="btn btn-success btn-lg">Create absence</a>
                </div>
                <h1>Absences</h1>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                    @php $i = ($absences->currentpage() - 1) * 20 @endphp
                    @foreach($absences as $absence)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $absence->user->full_name }}</td>
                            <td>{{ $absence->reason }}</td>
                            <td>{{ date('Y-m-d',$absence->date) }}</td>
                            <td>{{ $absence->created_at }}</td>
                            <td width="13%">
                                <a href="/admin/absences/{{$absence->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="/admin/absences/{{$absence->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="/admin/absences/{{$absence->id}}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$absences->links()}}</div>
            </div>
        </div>
    </div>

@endsection
