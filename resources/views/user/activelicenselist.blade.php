@extends('layouts.app')

@section('content')
<div class="container" >
     
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('License List') }}</div>
                <div class="card-body">
                    @if(isset($licenses))
                    <table border="1" style="width:100%" class="table table-striped">
                        <thead class="thead-dark">
                            <tr >
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('License Key') }} </th> 
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th> 
                                <th> {{ __('User Email') }} </th> 
                                <th> {{ __('Device Name') }} </th> 
                                <th> {{ __('Device Os') }} </th> 
                                <th> {{ __('Action') }} </th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                          
                                @foreach($licenses as $key=> $license)
                                    <tr>

                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ $license->deviceLicense[0]['license'] }} </td>
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
                                           <td> {{ $license->device_name ? $license->device_name : '' }} </td>
                                             <td> {{ $license->device_os ? $license->device_os : '' }} </td>
                                             <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->user_id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                             <td><a @click="openDetailModal({{$license->user_id}})" href="#"> {{ __('Details') }}  </a></td>
                                     
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                    <p> *nothing found</p>
                    @endif

                    <button type="button" class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#myModal">
  Open modal
</button>

  
  <!-- The Modal -->
<div class="modal w-100" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
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

<script type="text/javascript">
  window.onload = function () {
    var vm = new Vue({

        el:'#details',
        data:{
            message:'Hello vue',
        },
        methods:{
            openDetailModal:function(userid){
                axios.get('/user/getuserdetails/'+userid).then((res)=>{
                    console.log(res.data);
                    $('#myModal').modal('show');
                }).catch((error)=>{

                })
           

            },

        },

    })
}

</script>