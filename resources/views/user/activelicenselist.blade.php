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




        <div class="row" id="details">
         @include('partials_user/sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('License List') }}</div>
                <div class="card-body">
                    <div class="row custom_row_position ">
                        <div class="col-md-12 input-group mb-3">
                            @include('partials_general/searchbar')
                        </div>
                    </div>

                    
                <table  id="tableListing" border="1"  class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr >
                                <th> {{ __('Sr no') }} </th>
                                <th> {{ __('License Key') }} </th>
                                <th id="thn"> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th>
                                <th> {{ __('User Email') }} </th>
                                <th colspan="2"> {{ __('Action') }} </th>


                            </tr>
                        </thead>
                        <tbody>
                            
                                
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        

                                        <td> {{ $key + 1 }} </td>

                                      <td> {{ $license->license}} </td>
                                     <td>
                                            @if($license->license_type && $license->license_type->type == '1' )
                                                Monthly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                                Yearly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                                Life time {{ '('. $license->license_type->price . ')' }}
                                            @else
                                                Trial
                                           
                                            @endif
                                        </td>
                                       <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                         <td> {{ $license->user ? $license->user->email : '' }} </td>
                                        
                                        @if($license->license_type_id == '4')

                                             <td><a @click="openLicenseActivationModel({{ $license }})" href="javascript:void(0)"> {{ __('Purchase') }}  </a></td>
                                             {{-- <td><a @click="openDetailModal({{$license->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td> --}}
                                        @else
                                            <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                             <td><a @click="openDetailModal({{$license->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>
                                        @endif 

                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

 

    <div class="modal fade" id="licenseModal" tabindex="-1" role="dialog" aria-labelledby="LicenseModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                              <h5 class="modal-title font-weight-bold" id="LicenseModalLabel">License Activation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                            <form>
                              <div class="modal-body">
                                  <div class="form-activation">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="licensetype" value="1" v-model="purchase.license_type_id" id="monthlypackage" >
                                    <label class="form-check-label" for="monthlypackage">
                                     Monthly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="licensetype" value="2" v-model="purchase.license_type_id" id="yearlypackage">
                                    <label class="form-check-label" for="yearlypackage">
                                      Yearly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="licensetype" value="3" v-model="purchase.license_type_id" id="lifetimepackage">
                                    <label class="form-check-label" for="lifetimepackage">
                                      Lifetime
                                    </label>
                                </div>
                            </div>
                              </div>
                              <hr/>
                              <div class="modal-footer border-top-0 d-flex justify-content-center">
                                <button type="button" @click="purchaseLicense()" class="btn btn-license">Purchase</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>


  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">All Licenses</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <table class="table table-striped table-responsive">
    <thead>
      <tr >
                                <th> {{ __('Sr no') }} </th>
                                <th> {{ __('License Key') }} </th>
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th>
                                <th> {{ __('User Email') }} </th>
                                <th> {{ __('Device Name') }} </th>
                                <th> {{ __('Device Os') }} </th>
                                <th colspan="2" ><div class="action_header">{{ __('Action') }}</div>  </th>

                            </tr>
    </thead>
    <tbody>
      <tr  v-for="(row,key,index) in alldata" :key="row.id">
          
        <td>@{{key+1}}</td>
        <td>@{{row.license_id}}</td>
        
        <td><div v-if="row.license_type && row.license_type.type==1">Monthly(@{{row.license_type.price}})</div>
          <div v-if="row.license_type && row.license_type.type==2">Yearly(@{{row.license_type.price}})</div>
          <div v-if="row.license_type && row.license_type.type==3">Lifetime(@{{row.license_type.price}})</div></td>
         <td>@{{row.users[0].first_name}}</td>
        <td>@{{row.users[0].email}}</td>
        <td>@{{row.device_name}}</td>
        <td>@{{row.device_os}}</td>

       <td v-if="row.is_deactive == 0" ><a href="javascript:void(0)" @click="deactivedeviceandfetchagain(row.device_id)" class="btn btn-primary"> {{ __('Deactive') }}  </a></td>
        <td v-if="row.is_deactive == 1" ><a href="javascript:void(0)" @click="activatedeviceandfetchagain(row.device_id)" class="btn btn-success"> {{ __('Active') }}  </a></td>
        <td><a href="javascript:void(0)" @click="deleterecordandfetchagain(row.id)" class="btn btn-danger"> {{ __('Delete') }}  </a></td>



      </tr>

    </tbody>
  </table>
  </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
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
                console.log($value);

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user')}}',
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
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <script type="text/javascript">
  window.onload = function () {
    var vm = new Vue({

        el:'#details',
        data:{
            alldata:{},
            purchase:{

                    id:'',
                    user_id:'',
                    sales_person_id:'',
                    license_type_id:'1',
                    license:'',
                    license_duration:'',
                    license_expiry:'',
                    allowed_test:'',
                    no_of_devices_allowed:'',
                    is_deleted:'',
                    trial_activated_at:'',
                    license_activated_at:'',
                    user_device_unique_id:'',
                    is_active:'',
                    
                                                                                                                                  

            },
            licid:'',
            message:'Hello vue',
            myInput:'',

        },
        methods:{
            openLicenseActivationModel:function(license){
               this.purchase = license;
               $("#monthlypackage").prop("checked", true);
                   
               
                               
                    jQuery('#licenseModal').modal('show');

            },
            purchaseLicense:function(){
                console.log(this.purchase);
          
                   
                        axios.post('/purchase/license',this.purchase).then((res)=>{

                            Swal.fire({
                            icon: 'success',
                            title: 'Congratulations',
                            text: 'You have purchased License. Activate it on your device from which you started trial',
                            
                            }).then((result)=> {
                              if(result.value){
                                window.location.reload();
                              }
                              
                            })      
                            jQuery('#licenseModal').modal('hide');
                            
                         })
                    
                    
                
            },
            openDetailModal:function(licenseid){
                axios.get('/user/getuserdetails/'+licenseid).then((res)=>{
                this.licid = licenseid;
                console.log(this.licid);
                this.alldata = res.data;
                

                    jQuery('#myModal').modal('show');
                }).catch((error)=>{

                })


            },
            deleterecordandfetchagain:function(id){
              if(confirm("Are you sure? Your data will be deleted")){
                console.log(this.licid);
                   axios.get('/user/deletelicense/'+id)
                    .then((res)=> {
                        this.openDetailModal(this.licid);





                    })
              }else{
                return false;
              }
            },
             deactivedeviceandfetchagain:function(id){
              if(confirm("Do you want to deactivate this device?")){
                console.log(this.licid);
                   axios.get('/user/deactivatedevice/'+id)
                    .then((res)=> {


                        this.openDetailModal(this.licid);





                    })
              }else{
                return false;
              }
            },
            activatedeviceandfetchagain:function(id){
               if(confirm("Do you want to Activate this device?")){
                console.log(this.licid);
                   axios.get('/user/activatedevice/'+id)
                    .then((res)=> {


                        this.openDetailModal(this.licid);





                    })
              }else{
                return false;
              }

            },



        },
        mounted(){


        }

    })
}

</script>


