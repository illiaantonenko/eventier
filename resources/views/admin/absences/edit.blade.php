@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Edit absence</h1>
                <form method="post" action="/admin/absences/{{$absence->id}}">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="user">Author</label>
                        <select name="user" class="form-control">
                            <option value="" disabled>Select author ...</option>
                            @foreach($users as $user)
                                <option @if($user->id == $absence->user_id) selected @endif value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="reason">Reason</label>
                        <input type="text" id="reason" class="form-control"  name="reason" value="{{ $absence->reason }}">
                        @if($errors->has('reason'))
                            <span class="text-danger">{{$errors->get('reason')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">Date</label>
                        <input type="text" id="date" name="date" class="form-control" value="{{ date('d-m-Y',$absence->date) }}"/>
                        @if($errors->has('date'))
                            <span class="text-danger">{{$errors->get('date')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Save absence</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
