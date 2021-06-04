@extends('layouts.app')

@section('content')
<div class="container">

  <!--   <div class="row justify-content-center">
        </div> -->
        <div class="row">
        @include('layouts.partials_user.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                     {{__(' Welcome ').' '.Auth::user()->first_name.' : '.Auth::user()->userrole->role }}

                </div>
            </div>
        </div>
    </div>
        
    
    
</div>
@endsection
