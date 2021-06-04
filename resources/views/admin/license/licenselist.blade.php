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
                <div class="card-header"><span class="custom-card-header-span">{{ __('License List') }}</span> <a href="{{ route('createlicense') }}" class="btn btn-info btn-md button-add border border-light " >
          <i class="fas fa-plus"></i>Add License
        </a></div>
                <div class="card-body">
                    <div class="row custom_row_position ">
                        <div class="col-md-12 input-group mb-3">
                            @include('layouts.partials_general.searchbar')
                        </div>
                    </div>
                    @if(count($licenses) >0)

                    <table id="tableListing" border="1" style="overflow: scroll;"  class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th>
                                <th> {{ __('License Key') }} </th>
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th>
                                <th> {{ __('User Email') }} </th>
                                <th> {{ __('Sales Person Name') }} </th>
                                <th> {{ __('Trial Activated At') }} </th>
                                <th> {{ __('Expiry Date') }} </th>
                                <th> {{ __('Activated At') }} </th>
                                <th colspan="2"> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
                                        <td>
                                            @if($license->license_type && $license->license_type->type == '1' )
                                                Monthly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                                Yearly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                                Life time {{ '('. $license->license_type->price . ')' }}
                                                 @elseif ($license->license_type &&  $license->license_type->type == '4' )
                                                Trial {{ '('. $license->license_type->price . ')' }}
                                            @endif
                                        </td>
                                        <td> {{ $license->user ? $license->user->first_name : 'N/A' }} </td>
                                        <td> {{ $license->user ? $license->user->email : 'N/A' }} </td>
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : 'N/A' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_expiry }} </td>

                                        <td> {{ $license->license_activated_at }} </td>

                                        <td colspan="2">
                                            <a href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>

                                            |
                                            <a href="{{ route('deletelicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>

                                @endforeach

                        </tbody>
                    </table>
                    {{$licenses->render()}}
                    @include('layouts.partials_general.searchalert')
                    @else
                    <p> *nothing found</p>
                    @endif
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
                    url: '{{URL::to('license-search-results')}}',
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
