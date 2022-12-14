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
           @include('layouts.partials_salesman/sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('License List') }}</div>
                <div class="card-body">
                    <div class="row custom_row_position ">
                        <div class="col-md-12 input-group mb-3">
                            @include('layouts.partials_general.searchbar')
                        </div>
                    </div>
                    @if(count($licenses) >0)
                    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th>
                                <th> {{ __('License Key') }} </th>
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th>
                                <th> {{ __('User Email') }} </th>
                                <th> {{ __('Sales Person Name') }} </th>
                                <th> {{ __('Trial Activated At') }} </th>
                                <th> {{ __('Activated At') }} </th>
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
                                            @endif
                                        </td>
                                        <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{$licenses->render()}}
                    @else
                    <p> *nothing found</p>
                    @endif

                    @include('layouts.partials_general.searchalert')
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
    jQuery(document).ready(function(){
 jQuery('#myInput').on('keyup',function(){
$value=jQuery(this).val();
jQuery.ajax({
type : 'get',
url : '{{URL::to('salesperson-active-license-search-result')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
});
});
 jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
});


</script>
