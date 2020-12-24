@if(count($licenses)>0 || $licenses==NULL)

                        
                      <table  id="tableListing" border="1"  class="table table-striped table-responsive">
                        
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
                                           
                                             <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                             <td><a @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>
                                       
                                    </tr>
                                @endforeach
                        </tbody>
                        @else
                     <div class="alert alert-danger custom_warning" role="alert"><p class="custom_para_results">No Results for your search*</p>
  
</div>
@endif
                    </table>

                    


{{$licenses->render()}}