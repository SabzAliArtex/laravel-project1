
                       
                   <table  id="tableListing" border="1"  class="table table-striped table-responsive">
                   
                    <tbody>
                        
                            
                            @forelse($history as $key=> $row)
                                <tr>
                                    

                                    <td> {{ $key + 1 }} </td>

                                    <td> {{ $row->license?$row->license:'N/A'}} </td>
                                    <td>
                                        {{ get_license_type_text($license) }}    
                                    </td>
                                   
                                     <td> {{ $row->email? $row->email : 'N/A' }} </td>
                                    
                                    @if($row->license_type_id != '4')

                                 <td><a @click="openLicenseActivationModel({{ $row }})" href="javascript:void(0)"> {{ __('Purchase') }}  </a></td>
                                 {{-- <td><a @click="openDetailModal({{$row->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>  --}}
                                     @else
                                 <td><a href="{{ route('user.deleteuserlicense',['id'=>$row->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                 <td><a @click="openDetailModal({{$row->id}})" href="javascript:void(0)"> {{ __('Details') }}  </a></td>
                                    @endif 

                                </tr>
                                @empty
                                <p>nothing*</p>
                            @endforelse
                    </tbody>
                </table>
