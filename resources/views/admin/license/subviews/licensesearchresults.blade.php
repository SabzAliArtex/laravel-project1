@if($formatCheck == 1)
@if(count($licenses) >0)

                    <table id="tableListing" border="1" style="overflow: scroll;"  class="table table-striped table-responsive">
                       
                        <tbody>
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
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
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>

                                        <td colspan="2"> 
                                            <a href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>

                                            |
                                            <a href="{{ route('deletelicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>

                                @endforeach
                                
                        </tbody>
                    </table>
                    
                        
                    @else
                       <div class="alert alert-danger custom_warning" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif

@else
@if(count($licenses) >0)

                    <table id="tableListing" border="1" style="overflow: scroll;"  class="table table-striped table-responsive">
                        
                        <tbody>
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
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
                                        <td> {{ $license->fname ? $license->fname.' '.$license->lname : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>

                                        <td colspan="2"> 
                                            <a href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>

                                            |
                                            <a href="{{ route('deletelicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>

                                @endforeach
                                
                        </tbody>
                    </table>
                    
                    
                    @else
                       <div class="alert alert-danger custom_warning" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif





@endif