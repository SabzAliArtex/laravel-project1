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
         @include('partials_admin/sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('License List') }}</div>
                <div class="card-body">

                    @if(isset($licenses))
                    <table border="1"  class="table table-striped table-responsive" >
                        <thead class="thead-dark">
                            <tr >
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('License Key') }} </th> 
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th> 
                                <th> {{ __('User Email') }} </th>
                                <th> {{ __('Device Name') }} </th>
                                <th> {{ __('Device OS') }} </th>
                                <th> {{ __('Status') }} </th>
                                <!-- <th colspan="2" > {{ __('Action') }} </th> -->
                                
                            </tr>
                        </thead>
                        <tbody >
                          
                                @foreach($licenses as $key=> $license)
                                    <tr>

                                        <td> {{ $key + 1 }} </td>

                                      <td> {{ $license->deviceLicense[0]['license']}} </td>
                                     <td> 
                                            @if($license->license_type && $license->license_type->type == '1' )
                                                Monthly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                                Yearly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                                Life time {{ '('. $license->license_type->price . ')' }}
                                            @endif      
                                        </td>
                                       <td> {{ $license->users ? $license->users[0]['first_name'] : '' }} </td>
                                         <td> {{ $license->users ? $license->users[0]['email'] : '' }} </td>
                                           <td>{{$license->device_name}}</td>
                                         <td>{{$license->device_os}}</td>
                                           <td> @if($license->is_deleted == 1) Deleted
                                           @else
                                           Not Deleted
                                           @endif
                               {{--          </td>
                                       
                                         
                                             <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                             <td><a @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>
                                       --}}
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                    <p> *nothing found</p>
                    @endif
                      
            

  
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
          <table class="table table-striped table-responsive custom-scroll">
    <thead>
      <tr >
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('License Key') }} </th> 
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th> 
                                <th> {{ __('User Email') }} </th> 
                                <th> {{ __('Device Name') }} </th> 
                                <th> {{ __('Device Os') }} </th> 
                                <th colspan="2" > {{ __('Action') }} </th> 
                                
                            </tr>
    </thead>
    <tbody>
      <tr  v-for="(row,key,index) in alldata" :key="row.id">
        <td>@{{key+1}}</td>
        <td>@{{row.device_license[0].license}}</td>
        <td><div v-if="row.license_type && row.license_type.type==1">Monthly(@{{row.license_type.price}})</div>
          <div v-if="row.license_type && row.license_type.type==2">Yearly(@{{row.license_type.price}})</div>
          <div v-if="row.license_type && row.license_type.type==3">Lifetime(@{{row.license_type.price}})</div></td>
         <td>@{{row.users[0].first_name}}</td>
        <td>@{{row.users[0].email}}</td>
        <td>@{{row.device_name}}</td>
        <td>@{{row.device_os}}</td>
      
        <td><a href="javascript:void(0)" @click="deleterecordandfetchagain(row.id)"> {{ __('Delete') }}  </a></td>

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
            licid:'',
            message:'Hello vue',
        },
        methods:{
            openDetailModal:function(licenseid){
                axios.get('/user/getuserdetails/'+licenseid).then((res)=>{
                this.licid = licenseid;
                console.log(this.licid);
                this.alldata = res.data;

                    $('#myModal').modal('show');
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
           

        },
        mounted(){
          

        }

    })
}

</script>