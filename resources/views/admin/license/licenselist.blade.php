@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="details">
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

                    <table id="tableListing" border="1"  class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th>
                                <th> {{ __('License Key') }} </th>
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('Devices Allowed') }} </th>
                                <th> {{ __('User Name') }} </th>
                                <th> {{ __('User Email') }} </th>
                                <th> {{ __('Sales Person Name') }} </th>
                                <th> {{ __('Trial Activated At') }} </th>
                                <th> {{ __('Activated At') }} </th>
                                <th> {{ __('Expiry Date') }} </th>
                                <th colspan="2"> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
                                        <td>
                                            {{ get_license_type_text($license) }}
                                        </td>
                                        <td> {{ $license->no_of_devices_allowed }} </td>
                                        <td> {{ $license->user ? $license->user->first_name.' '.$license->user->last_name : '-' }} </td>
                                        <td> {{ $license->user ? $license->user->email : '-' }} </td>
                                        <td> 
                                            {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '-' }} 
                                        </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>
                                        <td> {{ $license->license_expiry }} </td>

                                        <td colspan="2">
                                            <a class="btn btn-sm btn-primary" @click="openDetailModal({{$license->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a>

                                            <a class="btn btn-sm btn-primary" href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('deletelicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
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
                                      <td>
                                        <div v-if="row.license_type && row.license_type.type==1">Monthly(@{{row.license_type.price}})</div>
                                        <div v-if="row.license_type && row.license_type.type==2">Yearly(@{{row.license_type.price}})</div>
                                        <div v-if="row.license_type && row.license_type.type==3">Lifetime(@{{row.license_type.price}})</div>
                                      </td>
                                      <td>@{{row.users[0].first_name}}</td>
                                      <td>@{{row.users[0].email}}</td>
                                      <td>@{{row.device_name}}</td>
                                      <td>@{{row.device_os}}</td>

                                      <td v-if="row.is_deactive == 0" >
                                        <a href="javascript:void(0)" @click="deactivedeviceandfetchagain(row.device_id)" class="btn btn-primary">     {{ __('Deactive') }}  
                                        </a>
                                      </td>
                                      <td v-if="row.is_deactive == 1" >
                                        <a href="javascript:void(0)" @click="activatedeviceandfetchagain(row.device_id)" class="btn btn-success"> {{ __('Active') }}  </a>
                                      </td>
                                      <td>
                                        <a href="javascript:void(0)" @click="deleterecordandfetchagain(row.id)" class="btn btn-danger"> 
                                          {{ __('Delete') }}  
                                        </a>
                                      </td>
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
                                                                                                                                  

            },
                  licid:'',
                  message:'Hello vue',
                  myInput:'',

        },
        methods:{
            openDetailModal:function(licenseid){   
                axios.get('getlicensedetails/'+licenseid).then((res)=>{
                this.licid = licenseid;
                this.alldata = res.data;
                  jQuery('#myModal').modal('show');
                }).catch((error)=>{

                })
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
