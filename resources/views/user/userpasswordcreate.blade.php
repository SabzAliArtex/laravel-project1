@extends('layouts.app')
@section('content')
<div class="card w-50 offset-3">
    <div class="card-header">Create Password</div>
    <div class="card-body" >
        <form method="post" action={{ route('update.password')}}>
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control " name="email" value="{{ $user->email }}"
                                            readonly="readonly" required autocomplete="off" autofocus="">

                                                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" value="" required="" autocomplete="email" autofocus="">

                                                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
</form></div>
</div>

@endsection