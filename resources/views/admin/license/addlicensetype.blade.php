@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>    </div>
        
        <div class="row">
        @include('partials/sidebar') 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add License type') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addLicenseType') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="off" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="name" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('Select license Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('type') is-invalid @enderror role" name="type" required>
                                      
                                    <option value=""> {{ __('Select License Type') }} </option>
                                    <option value="1"> Monthly </option>
                                    <option value="2"> Yearly </option>
                                    <option value="3"> Lifetime </option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('Select Allowed Test') }}</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_test[]" id="allowed_test" value="WCCVT">

                                    <label class="form-check-label" for="allowed_test">
                                        {{ __('WCCVT') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_test[]" id="made easy" value="Testing color vision made easy">

                                    <label class="form-check-label" for="made easy">
                                        {{ __('Testing color vision made easy') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_test[]" id="Older" value="Older testing color vision">

                                    <label class="form-check-label" for="Older">
                                        {{ __('Older testing color vision') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allowed_test[]" id="D-15" value="D-15">

                                    <label class="form-check-label" for="D-15">
                                        {{ __('D-15') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="active" value="1" checked="checked">

                                    <label class="form-check-label" for="active">
                                        {{ __('Active') }}
                                    </label>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0">

                                    <label class="form-check-label" for="inactive">
                                        {{ __('Inactive') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
   
</div>
@endsection
