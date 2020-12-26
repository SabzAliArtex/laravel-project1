@if($formatCheck == 1)
  @if(count($licenses)>0)
                    <table id="tableListing" border="1"  class="table table-striped table-responsive" >
                        
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
                                             <td><a @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>--}}
                                       
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    
                    
                    @else
                    <p> *nothing found</p>
                    @endif

@else
		  @if(count($licenses)>0)
                    <table id="tableListing" border="1"  class="table table-striped table-responsive" >
 						<tbody >
                          
                                @foreach($licenses as $key=> $license)
                                    <tr>

                                        <td> {{ $key + 1 }} </td>

                                      <td> {{ $license->license}} </td>
                                     <td> 
                                            @if($license->type && $license->type == '1' )
                                                Monthly {{ '('. $license->price . ')' }}
                                            @elseif ($license->type &&  $license->type == '2' )
                                                Yearly {{ '('. $license->price . ')' }}
                                            @elseif ($license->type &&  $license->type == '3' )
                                                Life time {{ '('. $license->price . ')' }}
                                            @endif      
                                        </td>
                                       <td> {{ $license->first_name ? $license->first_name : '' }} </td>
                                         <td> {{ $license->email ? $license->email : '' }} </td>
                                           <td>{{$license->device_name}}</td>
                                         <td>{{$license->device_os}}</td>
                                           <td> @if($license->is_deleted == 1) Deleted
                                           @else
                                           Not Deleted
                                           @endif
                               {{--          </td>
                                       
                                         
                                             <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                             <td><a @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>--}}
                                       
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    
                    
                    @else
                     <div class="alert alert-danger custom_warning_userdevs" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif

@endif