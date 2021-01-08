@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session('verified'))
                    <div class="alert alert-success" role="alert">
                        <p> Your account is verified! </p>
                    </div>
                @endif
            </div>
            @include('partials_admin/sidebar')

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{__(' Welcome ').' '.Auth::user()->first_name.' : '.Auth::user()->userrole->role }}
                        <style type="text/css">
                            .boxes {
                                margin-top: 1em;
                            }

                            .thumb {
                                border: 1px solid black;
                                border-radius: 3px;
                                padding: 6px;
                                text-align: center;
                                margin-bottom: 30px;
                            }

                            .thumb p {
                                margin-bottom: 0.1em;
                            }
                            img{
                                background: grey;
                                height:250px;
                                width: 100%;
                                border:1px solid grey;
                                margin-top: 20px;
                                box-shadow: 0 8px 6px -6px black;
                            }
                        </style>

                        <div class="row boxes">
                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    Total Users
                                    <p> {{ App\User::count() }} </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    Sales Persons
                                    <p> {{ App\User::where('role', 3)->count() }} </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    License Types
                                    <p>
                                    <p> {{ App\LicenseType::count() }} </p> </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    Total Licenses
                                    <p> {{ App\License::count() }} </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    Active Licenses
                                    <p> {{ App\License::where('trial_activated_at', '!=' , NULL)->count() }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                                <div class="thumb">
                                    Inactive Licenses
                                    <p> {{ App\License::where('trial_activated_at', NULL)->count() }} </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
