@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('Absence') }}</h1>
                <form action="/absences" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Insert your bullsh*t reason here so we could laugh on you
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="user" value="{{ auth()->user()->id }}"/>
                            </div>

                            <div class="form-group">
                                <label for="reason">{{ __('Reason') }}</label>
                                <textarea class="form-control" name="reason">{{ old('reason') }}</textarea>
                            </div>

                            <button class="btn btn-success btn-lg" type="submit">{{ __('Create absence') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
