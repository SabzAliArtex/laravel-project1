@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('verified'))
                <div class="alert alert-success" role="alert">
                    <p> Your account verified! </p>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Side Bar') }}</div>
                <div class="card-body">
                    <li> 
                        <a href="{{ route('userslist') }}"> {{ __('All Users') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('AddUser') }}"> {{ __('Add User') }} </a>
                    </li>

                    <li> 
                        <a href="{{ route('SalesPersons') }}"> {{ __('Sales Person List') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('addLicenseType') }}"> {{ __('Add License Types') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('licensetypes') }}"> {{ __('License Types') }} </a>
                    </li>

                    <li> 
                        <a href="{{ route('licenselist') }}"> {{ __('License List') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('createlicense') }}"> {{ __('Add license') }} </a>
                    </li>
                </div> 
            </div>       
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{__(' Welcome ').' '.Auth::user()->first_name.'-->'.Auth::user()->userrole->role }}
                    <style type="text/css">
                        .boxes{
                            margin-top:1em;
                        }
                        .thumb{
                            border: 1px solid black;
                            border-radius: 3px;
                            padding: 6px;
                            text-align: center;
                            margin-bottom: 30px;
                        }
                        .thumb p{
                            margin-bottom: 0.1em;
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
                                <p> <p> {{ App\LicenseType::count() }} </p> </p>
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
