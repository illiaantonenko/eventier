@extends('adminlte::page')

@section('content')
    @include('admin.elements.message')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Create absence</h1>
                <form method="post" action="{{ url('/admin/absences') }}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="user">Author</label>
                        <select name="user" class="form-control">
                            <option value="" selected disabled>Select author ...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{$errors->get('user')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="reason">Reason</label>
                        <input type="text" id="reason" class="form-control"  name="reason" value="{{old('reason')}}">
                        @if($errors->has('reason'))
                            <span class="text-danger">{{$errors->get('reason')[0]}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">Date</label>
                        <input type="text" id="date" name="date" class="form-control" placeholder="dd-mm-yyyy"/>
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
