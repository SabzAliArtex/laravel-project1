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
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="custom-card-header-span-settings">{{ __('Application Settings') }}</span>
                    </div>
                    <div class="card-body" id="card-check">

                        <ul class="nav nav-tabs mb-5">
                            <li class="active"><a data-toggle="pill" class="btn btn-default bg-white" id="hometab" href="#home">General
                                    Settings</a></li>
                            <li class="ml-1"><a  data-toggle="pill" class="btn btn-default bg-white" href="#menu1">Mail
                                    Settings</a></li>

                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane  active">
                                @if($settings != null || count($settings)<0)
                                    <form method="POST" action="{{ route('editappsettings') }}"
                                                              enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Application Name') }}</label>

                                        <div class="col-md-6">

                                            <input type="hidden" name="id" value="{{$settings->id}}">
                                            <input type="hidden" name="checkName" value="1">
                                            <input id="first_name" type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   name="app_name" value="{{ $settings->app_name }}" required
                                                   autocomplete="off"
                                                   autofocus>

                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                    <p style="text-align: center;color: red">*Settings not Set by Admin.</p>
                                @endif

                            </div>
                            <div id="menu1" class="tab-pane fade">
                                @if($settings != null || count($settings)<0)
                                      <form method="POST" action="{{ route('editappsettings') }}"
                                                                   enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail Mailer') }}</label>

                                            <div class="col-md-6">
                                                <input type="hidden" name="id" value="{{$settings->id}}">
                                                <input id="first_name" type="text"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       name="mail_mailer" value="{{ $settings->mail_mailer }}" required
                                                       autocomplete="off"
                                                       autofocus>

                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail Host') }}</label>

                                            <div class="col-md-6">
                                                <input id="last_name" type="text"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       name="mail_host" value="{{$settings->mail_host  }}" required
                                                       autocomplete="name"
                                                       autofocus>

                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail Port') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="text" value="{{ $settings->mail_port  }}"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="mail_port">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail Username') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="phone"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       name="mail_username"
                                                       value="{{ $settings->mail_username}}" required autocomplete="phone">

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail Encryption') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text" value="{{$settings->mail_enc }}"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="mail_enc"
                                                       required autocomplete="password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row comission_row">
                                            <label for="comission"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail from Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="comission" type="text" value="{{$settings->mail_fromAddress }}"
                                                       class="form-control @error('comission') is-invalid @enderror"
                                                       name="mail_fromAddress" autocomplete="comission">

                                                @error('comission')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row comission_row">
                                            <label for="comission"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Mail from Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="comission" type="text" value="{{$settings->mail_fromName }}"
                                                       class="form-control @error('comission') is-invalid @enderror"
                                                       name="mailFromUsername" autocomplete="comission">

                                                @error('comission')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Update Mail Settings') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <p style="text-align: center;color: red">*Settings not set by Admin.</p>
                                    @endif
                            </div>


                        </div>


                        <div class="mt-5">
                            <p style="text-align: center;color: red">*Warning,make changes carefully, as it is sensitive
                                information.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery('#myInput').on('keyup', function () {
                $value = jQuery(this).val();
                jQuery.ajax({
                    type: 'get',
                    url: '{{URL::to('users-search-results')}}',
                    data: {'search': $value},
                    success: function (data) {
                        $('tbody').html(data);
                        document.getElementById("thname").style.width = "1%";


                    }
                });
            });
        });
        jQuery.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    });


</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery('.search-filter').on('change', function () {
                $value = jQuery(this).val();
                console.log($value);
                jQuery.ajax({
                    type: 'get',
                    url: '{{URL::to('users-search-results')}}',
                    data: {'search': $value},
                    success: function (data) {
                        $('tbody').html(data);
                        document.getElementById("thname").style.width = "1%";


                    }
                });
            });
        });
        jQuery.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    });


</script>

