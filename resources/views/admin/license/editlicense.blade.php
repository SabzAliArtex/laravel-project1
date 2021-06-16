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
        </div>
        <div class="row">
            @include('layouts.partials_admin.sidebar')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit License type') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('editlicensepost') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('License') }}</label>
                                <input type="hidden" name="id" value="{{ $licenses->id }}">
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" required
                                           autocomplete="off" value="{{ $licenses->license }}" readonly="readonly">

                                    @error('title')
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
                                           value="{{ $licenses->no_of_devices_allowed }}" required autocomplete="off"
                                           placeholder="ex: 1">

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
                                            <option value="{{ $Licensetype->id }}"
                                                    @if($licenses->license_type_id ==$Licensetype->id ) selected @endif> {{ $Licensetype->title.' ( '.$Licensetype->price .' )' }} </option>
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
                                            <option value="{{ $sales_person->id }}"
                                                    @if($licenses->sales_person_id == $sales_person->id) selected @endif>
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
@endsection
