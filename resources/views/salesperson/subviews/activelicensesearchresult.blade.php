
 
  
                    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive">
                      
                        <tbody>
                                @forelse($licenses as $key=> $license)
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
                                       {{-- <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>--}}
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>
                                    </tr>
                                    @empty
                    <div class="alert alert-danger custom_warning_salesperson_activated" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                                @endforelse
                        </tbody>
                    </table>
                    
                    
                    


