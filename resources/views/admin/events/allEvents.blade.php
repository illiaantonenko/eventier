@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="pull-right">
                    <a href="/admin/events/create"  class="btn btn-success btn-lg">Create event</a>
                </div>
                <h1>Events</h1>
                <br>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Created</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                    @php $i = ($events->currentpage() - 1) * 20 @endphp
                    @foreach($events as $event)
                        @php  $i+=1 @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $event->user->full_name }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>@if($event->start) {{ date('Y-m-d h:i:s',$event->start) }} @else --- @endif</td>
                            <td>@if($event->end) {{ date('Y-m-d h:i:s',$event->end) }} @else --- @endif</td>
                            <td>{{ $event->created_at }}</td>
                            <td> <a href="/admin/events/{{$event->id}}/changestatus"> @if($event->published == 1) <i class="text-success fa fa-check"></i> @else <i class="text-danger fa fa-close"></i> </a> @endif </td>
                            <td width="13%">
                                <a href="/admin/events/{{$event->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="/admin/events/{{$event->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                <form method="post" action="/admin/events/{{$event->id}}" style="display:inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pagination-lg">{{$events->links()}}</div>
            </div>
        </div>
    </div>

@endsection
