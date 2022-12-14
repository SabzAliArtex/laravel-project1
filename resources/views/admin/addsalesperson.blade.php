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
                    <div class="card-header">{{ __('Add Sales Person') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('AddUser') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="is_salesperson" value="1">
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required autocomplete="off"
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required autocomplete="name"
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
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror" name="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row hidden">
                                <label for="Role"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Select Role') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('role') is-invalid @enderror role" name="role">

                                        <option selected="" disabled="" value=""> Please Select Role</option>
                                        @foreach($roles as $role)

                                            <option value="{{ $role->id }}" {{ ($role->id == '3') ? 'selected' : '' }}> {{ $role->role }} </option>
                                        @endforeach

                                    </select>

                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row commission_row">
                                <label for="commission"
                                       class="col-md-4 col-form-label text-md-right">{{ __('commission') }}</label>

                                <div class="col-md-6">
                                    <input id="commission" type="number" max="99999" step="1" min="0"
                                           class="form-control @error('commission') is-invalid @enderror"
                                           name="commission" autocomplete="commission">

                                    @error('commission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_active" id="active"
                                               value="1" checked="checked">

                                        <label class="form-check-label" for="active">
                                            {{ __('Active') }}
                                        </label>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input class="form-check-input" type="radio" name="is_active" id="inactive"
                                               value="0">

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.role').change(function () {
            var role = $(this).find('option:selected').text();
            console.log(role);
            if ($.trim(role) == 'Sales Person') {
                $('.commission_row').css('display', 'flex');
                $('#commission').prop('required', 'required');
            } else {
                $('.commission_row').css('display', 'none');
                $('#commission').prop('required', '');
            }
        });
    </script>
@endsection
