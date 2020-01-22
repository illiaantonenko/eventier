@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/user/profile',['id'=> $profile->id ]) }}" method="post" enctype="multipart/form-data">
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
                                <label for="middlename">{{ __('Middlename') }}</label>
                                <input name="middlename" type="text" class="form-control" value="{{ $profile->middlename }}" />
                            </div>
                            <div class="form-group">
                                <label for="lastname">{{ __('Lastname') }}</label>
                                <input name="lastname" type="text" class="form-control" value="{{ $profile->lastname }}" />
                            </div>
                            <div class="form-group">
                                <label for="nickname">{{ __('Nickname') }}</label>
                                <input name="nickname" type="text" class="form-control" value="{{ ($profile->nickname) ? $profile->nickname : " " }}" />
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('Phone number') }}</label>
                                <input name="phone" type="text" class="form-control" value="{{ $profile->phone }}" />
                            </div>
                            <div class="form-group">
                                <label for="birthdate">{{ __('Birth date') }}</label>
                                <input name="birthdate" type="text" id="datepicker" class="form-control" value="{{ date('d-m-Y',$profile->birthdate) }}" />
                                {{--TODO: fix this datapicker--}}
{{--                                <datepicker name="birthdate" :value="{{ json_encode($profile->birthdate)}}"></datepicker>--}}
                            </div>
                            <div class="form-group">
                                <label for="hideyear">{{ __('Hide year') }}</label>
                                <input name="hideyear" type="hidden" value="0"/>
                                <input name="hideyear" type="checkbox" value="1" @if($profile->hideyear == 1) checked @endif/>
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
