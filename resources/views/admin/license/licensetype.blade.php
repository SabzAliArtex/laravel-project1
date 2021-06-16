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
            @include('layouts.partials_admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><span class="custom-card-header-span">{{ __('License Types') }}</span> <a
                            href="{{ route('addLicenseType') }}"
                            class="btn btn-info btn-md button-add border border-light ">
                            <i class="fas fa-plus"></i>Add License Types
                        </a></div>
                    <div class="card-body">
                        <div class="row custom_row_position ">
                            <div class="col-md-12 input-group mb-3">
                                @include('layouts.partials_general.searchbar')
                            </div>
                        </div>
                        
                            <table id="tableListing" border="1" style="width:100%"
                                   class="table table-striped table-responsive">
                                <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr no') }} </th>
                                    <th> {{ __('Title') }} </th>
                                    <th> {{ __('Price') }} </th>
                                    <th> {{ __('Duration') }} </th>
                                    <th> {{ __('Allowed Tests') }} </th>
                                    <th> {{ __('Status') }} </th>
                                    <th> {{ __('Actions') }} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($license_types as $key=> $license_type)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license_type->title }} </td>
                                        <td> {{ $license_type->price }} </td>
                                        <td>
                                            {{ get_license_duration($license_type) }}
                                        </td>
                                        <td>
                                            @php
                                                $allowed_tests = json_decode($license_type->allowed_test);
                                                if(count($allowed_tests) > 0){
                                                    echo implode(" , ", $allowed_tests);
                                                }
                                            @endphp
                                        </td>
                                        <td> {{ $license_type->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('editlicensetype',['id'=>$license_type->id]) }}"> {{ __('Edit') }}  </a>
                                            |
                                            <a class="btn btn-sm btn-danger" href="{{ route('deletelicensetype',['id'=>$license_type->id]) }}"
                                               onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>
                                    @empty
                                     <p> *nothing found</p>
                                @endforelse
                                </tbody>
                            </table>@include('layouts.partials_general.searchalert')
                            {{$license_types->render()}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery('#myInput').on('keyup', function () {
                $value = jQuery(this).val();
                jQuery.ajax({
                    type: 'get',
                    url: '{{URL::to('license-types-search')}}',
                    data: {'search': $value},
                    success: function (data) {
                        $('tbody').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    });


</script>
