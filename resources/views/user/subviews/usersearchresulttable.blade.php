@if(count($licenses)>0 || $licenses==NULL)

                        
                      <table  id="#tableListing " border="1"  class="table table-striped table-responsive">
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
                                            @endif      
                                        </td>
                                       <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                         <td> {{ $license->user ? $license->user->email : '' }} </td>
                                           
                                         {{-- <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td> --}}
                                         @if($license->license_type_id == '4')

                                         <td><a onclick="openLicenseActivationModel({{ $license }},{{ $check = 1 }})" href="javascript:void(0)"> {{ __('Purchase') }}  </a></td> 
                                     
                                     @elseif($license->license_expiry && (strtotime($license->license_expiry) < strtotime(date('Y-m-d H:i:s') )))
                                     
                                        <td><a onclick="openLicenseActivationModel({{ $license }},{{ $check = 0 }})" href="javascript:void(0)"> {{ __('Renew') }}  </a></td>
                                   
                                     @else

                                         {{-- <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td> --}}
                                         <td><a onclick="openDetailModal({{$license->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>

                                     @endif 
                                             
                                       
                                    </tr>
                                @endforeach
                        </tbody>
                        @else
                     <div class="alert alert-danger  new-warning" role="alert"><p class="custom_para_results">No Results for your search*</p>
                                    
                        
</div>
@endif
                    </table>

                    
  <!-- The Modal -->
<div class="modal" id="myModalSearched">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">All Licenses</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  {{-- licensemodal --}}
  
 
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
            
          <td id="sr">@{{key+1}}</td>
          <td id="licenseidfetched">@{{row.license_id}}</td>
          
          <td id="licensetype"><div v-if="row.license_type && row.license_type.type==1">Monthly(@{{row.license_type.price}})</div>
            <div v-if="row.license_type && row.license_type.type==2">Yearly(@{{row.license_type.price}})</div>
            <div v-if="row.license_type && row.license_type.type==3">Lifetime(@{{row.license_type.price}})</div></td>
           <td id="username">@{{row.users[0].first_name}}</td>
          <td id ="email">@{{row.users[0].email}}</td>
          <td id="devname">@{{row.device_name}}</td>
          <td id="devos">@{{row.device_os}}</td>
  
         <td id="deactive" style="display:none"  ><a href="javascript:void(0)"  class="btn btn-primary"> {{ __('Deactive') }}  </a></td>
          <td id="active" style="display:none"  ><a href="javascript:void(0)" class="btn btn-success"> {{ __('Active') }}  </a></td>
          <td><a id="deleteandfetch" href="javascript:void(0)" class="btn btn-danger"> {{ __('Delete') }}  </a></td>
  
  
  
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


{{$licenses->render()}}
<script>

   var $value;
   function openLicenseActivationModel(license,check)
   {
          
    jQuery("#monthlypackage").prop("checked", true);   
                                            
    jQuery('#licenseModal').modal('show');

   }
    function openDetailModal(id)
    {
            
     
       jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#detailsModal').on('click',function(){
                $value=id;
                window.localStorage.clear();
                
                localStorage.setItem("id", $value);

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user/getuserdetailssub')}}',
                    data:{'search':$value},
                    success:function(data){
                        jQuery('#myModalSearched').modal('show');
                        
                        for (var i=0; i<data.length; i++) {
                                jQuery('#sr').text((i +  parseInt(1)))
                                jQuery('#licenseidfetched').text((data[i].license_id))
                                
                                if((data[i].license_type != null) && (data[i].license_type.type==1))
                                {
                                    jQuery('#licensetype').text('Monthly ('+(data[i].license_type.price) +')' )

                                }
                                else if((data[i].license_type != null) && (data[i].license_type.type==2))
                                {
                                    jQuery('#licensetype').text('Yearly ('+(data[i].license_type.price) +')' )
                                }
                                else if((data[i].license_type != null) && (data[i].license_type.type==3))

                                {
                                    jQuery('#licensetype').text('Lifetime ('+(data[i].license_type.price) +')' )
                                }
                                else{
                                    jQuery('#licensetype').text('Trial' )
                                    
                                }
                                if(data[i].is_deactive == 0)
                                {

                                    $('#deactive').css('display', 'block');
                                    $('#active').css('display', 'none');

                                }else if(data[i].is_deactive == 1)
                                {
                                    $('#deactive').css('display', 'none');
                                    $('#active').css('display', 'block');
                                }
                                
                                jQuery('#username').text((data[i].users[0].first_name + data[i].users[0].last_name))
                                jQuery('#email').text((data[i].users[0].email))
                                jQuery('#devname').text((data[i].device_name))
                                localStorage.setItem('device_id',data[i].device_id)
                                jQuery('#devos').text((data[i].device_os))

                             //   jQuery('#licenseidfetched').text((data[i].license_id))
}
                        
                        
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
  
  
  
  }
  
  

    // Your jquery code
    jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#deleteandfetch').on('click',function(){
                var id = localStorage.getItem('id');
                

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user/deletelicensesearch')}}',
                    data:{'search':id},
                    success:function(data){

                        window.location.reload();
                        
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    
    

            
            
            // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#deactive').on('click',function(){
                var devid = localStorage.getItem('device_id')
                console.log(devid)
                

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user/deactivatedevice')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('table').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    
        
            // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#active').on('click',function(){
                var devid = localStorage.getItem('device_id')
                console.log(devid)
                

                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('user/activatedevice')}}',
                    data:{'search':$value},
                    success:function(data){
                        $('table').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    
</script>