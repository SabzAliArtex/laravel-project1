@extends('layouts.app')

@section('content')
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<div class="container" id="paymentStatus">
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
        @include('partials_admin/sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('License List') }}</div>
                <div class="card-body">
                    @include('partials_general/searchbar')
                    @if(count($payments) >0)
                    <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"  class="table table-striped table-responsive ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="ellipsis"> {{ __('Sr no') }} </th> 
                                <th class="ellipsis"> {{ __('License Id') }} </th> 
                                <th class="ellipsis"> {{ __('Sales Person Id') }} </th>
                                <th class="ellipsis"> {{ __('Commission') }} </th> 
                                <th class="ellipsis"> {{ __('Status') }} </th> 
                                <th class="ellipsis"> {{ __('Sales Person Name') }} </th> 
                                
                                <th colspan="2"> {{ __('Actions') }} </th> 
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach($payments as $key=> $payment)
                                    <tr>
                                        
                                        <td  class="ellipsis"> {{ $key+1 }} </td>
                                        <td class="ellipsis"> {{ $payment->license_id }} </td>
                                        <td class="ellipsis">{{$payment->sales_person_id}}</td><td class="ellipsis">{{$payment->commission}}</td>
                                        
                                        @if($payment->is_approved == 0)
                                        <td  class="ellipsis ">Pending</td>
                                        @endif
                                        <td class="ellipsis">{{$payment->sales_person->first_name}}</td>
                                    {{--    <td> 
                                            @if($license->license_type && $license->license_type->type == '1' )
                                                Monthly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                                Yearly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                                Life time {{ '('. $license->license_type->price . ')' }}
                                            @endif      
                                        </td>
                                        --}}
                                    {{--     <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td> --}}

                                        <td colspan="2"> 
                                            {{-- route('paymentstatus',['id'=>$payment->id])
                                            {{ route('deletelicense',['id'=>$payment->id]) }}  
                                           
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
                                         
                                            --}}
                                          
                                           
                                             <a class="response"  v-on:click="changeActiveStatus({{$payment->id}})" href="javascript:void(0)" id="Approved"  > {{ __('Approve') }}  </a> 

                                           <!-- |
                                          
                                        

                                           
                                        

                                            <a class="response" v-on:click="changeDeactiveStatus({{$payment->id}})" href="javascript:void(0)" id="Disapprove"  > {{ __('Disapprove') }}  </a> 
                                            
                                        </td> -->
                                    </tr>

                                @endforeach
                                
                        </tbody>
                    </table>
                    @include('partials_general/searchalert')
                    {{$payments->render()}}
                    <div></div>
                    @else
                    <p> *nothing found</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<script type="text/javascript">
 window.onload=function(){
    var v = new Vue({
el:'#paymentStatus',
data:{

    message:'',
    payment_id:'',
    approve:'',
    disapprove:'',
    current_value:'',
    is_approve:'',
    is_deapprove:'',
    is_clicked:'',
    is_clicked_a:'',
    is_clicked_b:'',
    is_approve_status:'Hello VUE',
    response_check:false,
    is_current_result:true,
    is_button_check:'',
    
},
methods:{
    changeActiveStatus:function(para){
        var t = $('#Approved').text();
        if(t.match("Approve")){
 if(confirm("Do you want to approve?")){
    this.payment_id = para;
   axios.get('/paymentstatus/'+this.payment_id+'/'+t).then((res)=>{
    if ( res.data.is_approved == 1) {
        this.response_check = true;
        this.is_current_result=false;
        this.is_approve_status = "Loading..";
            Swal.fire({
                confirmButtonColor:'#7a97b3',
              icon: 'success',
              title: 'Successful',
              text: 'Payment Approved!',
             
            }).then(function(){
                  document.location.reload(true); 
            } );
     

    }
            }).catch((error)=>{

        })}else{
                return false;
            }
        
   
   
     }else{
        return false;
     }
     
     
       


        

    },
    changeDeactiveStatus:function(para){
        var s = $('#Disapprove').text();
        if(s.match("Disapprove"))
     {
this.payment_id = para;
   axios.get('/paymentstatus/'+this.payment_id+'/'+s).then((res)=>{
    this.is_approve_status = res.data.is_approved;
    if ( res.data.is_approved == 0) {
        this.is_approve_status = "Pending";
        this.response_check = true;
        this.is_current_result=false;
    }
            }).catch((error)=>{

        })
     }else{
        return false;
     }
        


        

    },
},


    });
}

</script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    // Your jquery code
     jQuery.noConflict();
    jQuery(document).ready(function(){
 jQuery('#myInput').on('keyup',function(){
$value=jQuery(this).val();
jQuery.ajax({
type : 'get',
url : '{{URL::to('commission-pending-search')}}',
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