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
                            {{ get_license_type_text($license) }}
                        </td>
                        <td> {{ $license->user ? $license->user->first_name.' '.$license->user->last_name : '' }} </td>
                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                        <td>
                            @if($license->license_type_id == '4')
                              <a class="btn btn-sm btn-warning" @click="openLicenseActivationModel({{ $license }},{{ $check = 1 }})" href="javascript:void(0)"> {{ __('Purchase') }}  </a>
                            @elseif($license->license_expiry && (strtotime($license->license_expiry) < strtotime(date('Y-m-d H:i:s') )))
                               <a class="btn btn-sm btn-success" @click="openLicenseActivationModel({{ $license }},{{ $check = 0 }})" href="javascript:void(0)"> {{ __('Renew') }}  </a>
                            @else
                                {{-- <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td> --}}
                            @endif 
                            <a class="btn btn-sm btn-primary" @click="openDetailModal({{$license->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a>

                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="modal fade" id="licenseModal" tabindex="-1" role="dialog" aria-labelledby="LicenseModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                        <h5 class="modal-title font-weight-bold" id="LicenseModalLabel">Purchase License</h5>
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
                          <br>
                        </div>
                        <div class="imp-message">
                          <span class="danger" style="color: red">* This will redirect you to <b>Shopify</b> to complete transaction.<br>
                          ** Use same email while entering information so that <b>Purchase</b> can be reflect on this account. </span>
                        <hr/>
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                          <button v-show ="purchase.check==1" type="button" @click="purchaseLicense(purchase.check)" class="btn btn-license">Purchase</button>
                          <button v-show ="purchase.check==0" type="button" @click="purchaseLicense(purchase.check)" class="btn btn-license">Purchase</button>
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
                            <h4 class="modal-title">Active Devices Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="error" v-if="isMessage">
                              @{{ errorMessage }}
                            </div>
                            <table class="table table-striped table-responsive">
                              <thead>
                                <tr >
                                  <th> {{ __('Sr no') }} </th>
                                  <th> {{ __('Activation Email') }} </th>
                                  <th> {{ __('Device id') }} </th>
                                  <th> {{ __('Action') }} </th>
                                </tr>
                              </thead>
                              <tbody v-if="alldata.length">
                                <tr v-for="(row,key,index) in alldata" :key="row.id">
                              
                                  <td>@{{key+1}}</td>
                                  <td>@{{row.users[0].email}}</td>
                                  <td>@{{row.device_id}}</td>
                                  <td >
                                    <div v-if="row.is_deactive == 0" >
                                      <a href="javascript:void(0)" @click="deactivedeviceandfetchagain(row.device_id)" class="btn btn-primary">     {{ __('Deactive') }}  
                                      </a>
                                    </div>
                                    <div v-if="row.is_deactive == 1" >
                                      <a href="javascript:void(0)" @click="activatedeviceandfetchagain(row.device_id)" class="btn btn-success"> {{ __('Active') }}  </a>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                              <tbody v-else>
                                <tr>
                                    <td colspan="8"> * No Record Found </td>
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

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <script type="text/javascript">
  window.onload = function () {
    var vm = new Vue({

        el:'#details',
        data:{
            alldata:{},
            purchase:
            {
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
                  link : '', 
                  interval : '', 
                  errorMessage : '', 
                  isMessage : false, 
                                                                                                                                  

            },
                  licid:'',
                  message:'Hello vue',
                  myInput:'',

        },
        methods:{
            openLicenseActivationModel:function(license,check){
                
               this.purchase = license;
               this.purchase.check = check;
               $("#monthlypackage").prop("checked", true);                         
                jQuery('#licenseModal').modal('show');
            },
            purchaseLicense:function(check){
              if(this.purchase.license_type_id == 1)
              {
                interval = "&interval="+"{{ Config::get('constants.VARIANT_ID.MONTHLY') }}"; 
              } else if(this.purchase.license_type_id == 2) {
                interval = "&interval="+"{{ Config::get('constants.VARIANT_ID.YEARLY') }}"; 
              }else if(this.purchase.license_type_id == 3) {
                interval = "&interval="+"{{ Config::get('constants.VARIANT_ID.LIFETIME') }}"; 
              } else{
                interval = "";
              }
              link = "{{ Config::get('constants.SHOPIFY_PRODUCT_LINK') }}"+'?licenseCode='+this.purchase.license+interval;

              window.open
                (
                  link,'_blank' 
                );
              return;
              
              axios.post('purchase/license',this.purchase).then((res)=>{

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
                axios.get('getuserdetails/'+licenseid).then((res)=>{
                this.licid = licenseid;
                this.alldata = res.data;
                  jQuery('#myModal').modal('show');
                }).catch((error)=>{

                })
            },
            deleterecordandfetchagain:function(id){
              if(confirm("Are you sure? Your data will be deleted")){
                console.log(this.licid);
                   axios.get('deletelicense/'+id)
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
                   axios.get('deactivatedevice/'+id)
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
                   axios.get('activatedevice/'+id)
                    .then((res)=> {
                      this.errorMessage = res.data;
                      //this.isMessage = true;
                      this.openDetailModal(this.licid);
                    })
              }else{
                return false;
              }
            },
        },
        mounted(){
          
        // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#myInput').on('keyup',function(){
                $value=jQuery(this).val();
                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('table').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    

        }

    })
}

</script>


