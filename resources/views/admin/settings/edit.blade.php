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
            </div>  </div>

        <div class="row">
            @include('partials_admin/sidebar')

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('editappsettings') }}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$settings->id}}" method="POST">
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('App Name') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="app_name" class="form-control" autocomplete="0"  value="{{$settings->app_name}}" >
                                    @error('app_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('App URL') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="app_url" class="form-control" autocomplete="0" required value="{{$settings->app_url}}" >
                                    @error('app_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('App ENV') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="app_env" class="form-control" autocomplete="0" required value="{{$settings->app_env}}" >
                                    @error('app_env')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('App KEY') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="app_key" class="form-control" autocomplete="0" required value="{{$settings->app_key}}" >
                                    @error('app_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('App DEBUG') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="app_debug" class="form-control" autocomplete="0" required value="{{$settings->app_debug}}" >
                                    @error('app_debug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.role').change(function(){
            var role = $(this).find('option:selected').text();
            console.log(role);
            if($.trim(role) == 'Sales Person'){
                $('.comission_row').css('display','flex');
                $('#comission').prop('required','required');
            } else{
                $('.comission_row').css('display','none');
                $('#comission').prop('required','');
            }
        });
    </script>
@endsection
