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
        <div class="row" id="details">
            @include('layouts.partials_user.sidebar')
           <div class="col-md-9">
               <div class="card">
                   <div class="card-header">{{ __('License List') }}</div>
                   <div class="card-body">
                       <div class="row custom_row_position ">
                           <div class="col-md-12 input-group mb-3">
                               @include('layouts.partials_general.searchbar')
                           </div>
                       </div>
   
                       
                   <table  id="tableListing" border="1"  class="table table-striped table-responsive">
                           <thead class="thead-dark">
                               <tr >
                                   <th> {{ __('Sr no') }} </th>
                                   <th> {{ __('License Key') }} </th>
                                   <th id="thn"> {{ __('License Type') }} </th>
                    
                                   <th> {{ __('User Email') }} </th>
                                   <th colspan="2"> {{ __('Action') }} </th>
   
   
                               </tr>
                           </thead>
                           <tbody>
                               
                                   
                                   @foreach($history as $key=> $row)
                                       <tr>
                                           
   
                                           <td> {{ $key + 1 }} </td>
   
                                         <td> {{ $row->license?$row->license:'N/A'}} </td>
                                        <td>
                                               @if($row->license_type_id &&  $row->license_type_id == '1' )
                                                   Monthly
                                               @elseif ($row->license_type_id && $row->license_type_id  == '2' )
                                                   Yearly
                                               @elseif ($row->license_type_id && $row->license_type_id  == '3' )
                                                   Lifetime
                                               @else
                                                   Trial
                                              
                                               @endif
                                           </td>
                                          
                                            <td> {{ $row->email? $row->email : 'N/A' }} </td>
                                           
                                           @if($row->license_type_id != '4')
   
                                        <td><a @click="openLicenseActivationModel({{ $row }})" href="javascript:void(0)"> {{ __('Purchase') }}  </a></td>
                                        {{-- <td><a @click="openDetailModal({{$row->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>  --}}
                                            @else
                                        <td><a href="{{ route('user.deleteuserlicense',['id'=>$row->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                        <td><a @click="openDetailModal({{$row->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>
                                           @endif 
   
                                       </tr>
                                   @endforeach
                           </tbody>
                       </table>
   
    

   
   
   
   </div>
                  </div>
               </div>
           </div>
        
</div>
<script>
        
        // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#myInput').on('keyup',function(){
                $value=jQuery(this).val();
                console.log($value);

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user/purchase-history')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection