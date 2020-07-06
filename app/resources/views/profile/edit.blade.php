@php
    use App\Models\Profile;
    /**
     * @var Profile $profile
    */
@endphp
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.profile.update',['id'=> $profile->id ]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <input type="image" src="{{ $profile->image->profile->url }}"/>
                                <input type="file" id="my_file" style="display: none;" />
                                @if($errors->has('image'))
                                    <span class="text-danger">{{$errors->get('image')[0]}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="firstname">{{ __('Firstname') }}</label>
                                <input name="firstname" type="text" class="form-control" value="{{ $profile->firstname }}" />
                            </div>
                            <div class="form-group">
                                <label for="lastname">{{ __('Lastname') }}</label>
                                <input name="lastname" type="text" class="form-control" value="{{ $profile->lastname }}" />
                            </div>
                            <div class="form-group">
                                <label for="nickname">{{ __('Nickname') }}</label>
                                <input name="nickname" type="text" class="form-control" value="{{ ($profile->nickname) ?? "" }}" />
                            </div>
                            <div class="form-group">
                                <label for="datepicker">{{ __('Birth date') }}</label>
                                <input name="birthdate" type="text" id="datepicker" class="form-control" value="{{ $profile->user->birthday->date->toDateString() }}" />
                                {{--TODO: fix this datapicker--}}
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success btn-lg">{{ __('Edit data') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
