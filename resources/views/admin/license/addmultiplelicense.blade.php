@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
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
        </div>

        <div class="row">
            @include('layouts.partials_admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Add License') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('license.multiple.add') }}" enctype="multipart/form-data" name="addmultiplelicense">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Number of Licenses') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="number"
                                           class="form-control @error('title') is-invalid @enderror" name="numberoflicenses"
                                           value="1" required autocomplete="off"
                                           min="1"  placeholder="Cannot be empty or less than 1" >

                                    @error('license')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('No. of device Allowed') }}</label>

                                <div class="col-md-6">
                                    <input id="noofdevs" type="number"
                                           class="form-control @error('title') is-invalid @enderror" name="numofdevs"
                                           required autocomplete="off" placeholder="1" min="1" value="1">

                                    @error('license')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Role"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Select license Type') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('licensetype') is-invalid @enderror role"
                                            name="license_type" required>

                                        <option value=""> Select License Type</option>
                                        @foreach($Licensetypes as $Licensetype)
                                            <option
                                                value="{{ $Licensetype->id }}"> {{ $Licensetype->title.' ( '.$Licensetype->price .' )' }} </option>
                                        @endforeach
                                    </select>

                                    @error('licensetype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Role"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Select Sales Person') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('salesperson') is-invalid @enderror role"
                                            name="sales_person">

                                        <option value=""> Select Sales person</option>
                                        @foreach($sales_persons as $sales_person)
                                            <option value="{{ $sales_person->id }}">
                                                {{ $sales_person->first_name.' '.$sales_person->last_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('licensetype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" >
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
