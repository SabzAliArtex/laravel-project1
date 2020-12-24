@if($formatCheck == 1)

  @if(count($license_types) >0)
                    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive-xl  ">
                        
                        <tbody>
                                @foreach($license_types as $key=> $license_type)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license_type->title }} </td>
                                        <td> {{ $license_type->price }} </td>
                                        <td> 
                                            @if( $license_type->type == '1' )
                                                Monthly
                                            @elseif ( $license_type->type == '2' )
                                                Yearly
                                            @elseif ( $license_type->type == '3' )
                                                Life time
                                            @endif      
                                        </td>
                                        <td> 
                                            @php 
                                                $allowed_tests = json_decode($license_type->allowed_test);
                                                if(count($allowed_tests) > 0){
                                                    echo implode(" , ", $allowed_tests);
                                                }
                                            @endphp
                                        </td>
                                        <td> {{ $license_type->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td> 
                                            <a href="{{ route('editlicensetype',['id'=>$license_type->id]) }}"> {{ __('Edit') }}  </a>
                                            |
                                            <a href="{{ route('deletelicensetype',['id'=>$license_type->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    
                    @else
                       <div class="alert alert-danger custom_warning" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif
@else

  @if(count($license_types) >0)
                    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive-xl  ">
                        
                        <tbody>
                                @foreach($license_types as $key=> $license_type)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license_type->title }} </td>
                                        <td> {{ $license_type->price }} </td>
                                        <td> 
                                            @if( $license_type->type == '1' )
                                                Monthly
                                            @elseif ( $license_type->type == '2' )
                                                Yearly
                                            @elseif ( $license_type->type == '3' )
                                                Life time
                                            @endif      
                                        </td>
                                        <td> 
                                            @php 
                                                $allowed_tests = json_decode($license_type->allowed_test);
                                                if(count($allowed_tests) > 0){
                                                    echo implode(" , ", $allowed_tests);
                                                }
                                            @endphp
                                        </td>
                                        <td> {{ $license_type->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td> 
                                            <a href="{{ route('editlicensetype',['id'=>$license_type->id]) }}"> {{ __('Edit') }}  </a>
                                            |
                                            <a href="{{ route('deletelicensetype',['id'=>$license_type->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    
                    @else
                       <div class="alert alert-danger custom_warning" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif


@endif