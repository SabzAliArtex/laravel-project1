@extends('layouts.app')

@section('content')
<div class="container" >
   
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
        @include('partials_salesman/sidebar')
        <div class="col-md-8" id="p">
            <div class="card">
                <div class="card-header">{{ __('License List') }} </div>
              
                <div class="card-body">
             <div class="row" style="margin-left: 3px">
                <div class="col-lg-4">
                    <div class="row">
                    <h6 style="font-weight: bold;">Commission Earned: </h6>
                    <h6 style="font-weight: bold;">@{{total_commission}} USD</h6></div>
                
                </div>
                <div class="col-lg-4">
                    <div class="row">
                   </div>
                
                </div>
               
                <div class="col-lg-4">
                    <div class="row"><h6 style="font-weight: bold;">Pending Clearanace: </h6>
                    <h6 style="font-weight: bold;">@{{pending_commision}} USD</h6></div>
                    
                </div>

           

          
        
        </div>         
                    @if(count($licenses) >0)
                    <table border="1"  class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('License Key') }} </th> 
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th> 
                                <th> {{ __('User Email') }} </th> 
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
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
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
<script >
    window.onload = function(){    
    var vm = new Vue({
        el:'#p',
        data:{
        pending_commision:'0',
        total_commission:0,
        },
        methods:{
            get_pending_commision:function(){

                axios.get('/salesperson/pending_commision').then((res)=>{
                    
                    this.pending_commision = res.data.commission;

                }).catch((error)=>{

                })
            },
            getTotalCommission:function(){
                axios.get('/salesperson/total_commision').then((res)=>{

                        
                        
                        if(res.data.commission == null){
                            this.total_commission = 0;
                        }else{
                            this.total_commission = res.data.commission;
                        }
                }).catch((error)=>{

                })
            }
        },

          mounted(){
            this.get_pending_commision();
            this.getTotalCommission();
          }


    });
}
</script>
