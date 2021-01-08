@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Side Bar') }}</div>
                <div class="card-body">
                    <li>
                        <a href="{{ route('salesperson.license') }}"> {{ __('All Licenses') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('salesperson.activelicense') }}"> {{ __('Activated Licenses') }} </a>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
