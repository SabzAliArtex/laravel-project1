

            
 @if(count($payments) >0)
                    <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"  class="table table-striped table-responsive ">
                       
                        <tbody>
                            
                                @foreach($payments as $key=> $payment)
                                    <tr>
                                        
                                        <td  class="ellipsis"> {{ $key+1 }} </td>

                                        <td class="ellipsis"> {{ $payment->license_id }} </td>
                                        <td class="ellipsis">{{$payment->sales_person_id}}</td><td class="ellipsis">{{$payment->commission}}</td>
                                        
                                        @if($payment->is_approved == 0)
                                        <td  class="ellipsis ">Pending</td>
                                        @endif
                                        <td class="ellipsis">{{$payment->first_name}}</td>
                                    {{--    <td> 
                                            @if($license->type && $license->type == '1' )
                                                Monthly {{ '('. $license->price . ')' }}
                                            @elseif ($license->type &&  $license->type == '2' )
                                                Yearly {{ '('. $license->price . ')' }}
                                            @elseif ($license->type &&  $license->type == '3' )
                                                Life time {{ '('. $license->price . ')' }}
                                            @endif      
                                        </td>
                                        --}}
                                    {{--     <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td> --}}

                                        <td colspan="2"> 
                                            {{-- route('paymentstatus',['id'=>$payment->id])
                                            {{ route('deletelicense',['id'=>$payment->id]) }}  
                                           
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
                                         
                                            --}}
                                          
                                           
                                             <a class="response Approvedr" id="Approved" data-value="{{$payment->id}}"  href="javascript:void(0)"   > {{ __('Approve') }}  </a> 

                                           <!-- |
                                          
                                        

                                           
                                        

                                            <a class="response" v-on:click="changeDeactiveStatus({{$payment->id}})" href="javascript:void(0)" id="Disapprove"  > {{ __('Disapprove') }}  </a> 
                                            
                                        </td> -->
                                    </tr>

                                @endforeach
                                
                        </tbody>
                    </table>
                    
                    <div></div>
                    @else
                     <div class="alert alert-danger custom_warning_pending_commission" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                    @endif

