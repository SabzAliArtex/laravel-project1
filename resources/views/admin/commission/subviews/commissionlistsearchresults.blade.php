<div id="paymentStatus">@if($formatCheck == 1)
        @if(count($payments) >0)
            <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"
                   class="table table-striped table-responsive-xl ">

                <tbody>

                @foreach($payments as $key=> $payment)
                    <tr>

                        <td class=""> {{ $key+1 }} </td>
                        <td class=""> {{ $payment->license_id }} </td>
                        <td class="">{{$payment->sales_person_id}}</td>
                        <td class="">{{$payment->commission}}</td>

                        @if($payment->is_approved == 1)
                            <td class=" ">Approved</td>
                        @else

                            <td class=" ">Pending</td>
                        @endif
                        <td class="">{{$payment->sales_person->first_name}}</td>
                    {{--    <td>
                            @if($license->license_type && $license->license_type->type == '1' )
                                Monthly {{ '('. $license->license_type->price . ')' }}
                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                Yearly {{ '('. $license->license_type->price . ')' }}
                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                Life time {{ '('. $license->license_type->price . ')' }}
                            @endif
                        </td>
                        --}}
                    {{--     <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                        <td> {{ $license->trial_activated_at }} </td>
                        <td> {{ $license->license_activated_at }} </td> --}}

                    <!-- <td colspan="2">
                                            {{-- route('paymentstatus',['id'=>$payment->id])
                                            {{ route('deletelicense',['id'=>$payment->id]) }}

v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})

                                            --}}


                        <a class="response"  v-on:click="changeActiveStatus({{$payment->id}})" href="javascript:void(0)" id="Approved"  > {{ __('Approve') }} </a>

                                            |






                                            <a class="response" v-on:click="changeDeactiveStatus({{$payment->id}})" href="javascript:void(0)" id="Disapprove"  > {{ __('Disapprove') }} </a>

                                        </td> -->
                    </tr>

                @endforeach

                </tbody>
            </table>


            <div></div>
        @else
            <p> *nothing found</p>
        @endif
    @else
        @if(count($payments) >0)
            <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"
                   class="table table-striped table-responsive-xl ">

                <tbody>

                @foreach($payments as $key=> $payment)
                    <tr>

                        <td class=""> {{ $key+1 }} </td>
                        <td class=""> {{ $payment->license_id }} </td>
                        <td class="">{{$payment->sales_person_id}}</td>
                        <td class="">{{$payment->commission}}</td>

                        @if($payment->is_approved == 1)
                            <td class=" ">Approved</td>
                        @else

                            <td class=" ">Pending</td>
                        @endif
                        <td class="">{{$payment->first_name}}</td>
                    {{--    <td>
                            @if($license->license_type && $license->license_type->type == '1' )
                                Monthly {{ '('. $license->license_type->price . ')' }}
                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                Yearly {{ '('. $license->license_type->price . ')' }}
                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                Life time {{ '('. $license->license_type->price . ')' }}
                            @endif
                        </td>
                        --}}
                    {{--     <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                        <td> {{ $license->trial_activated_at }} </td>
                        <td> {{ $license->license_activated_at }} </td> --}}

                    <!-- <td colspan="2">
                                            {{-- route('paymentstatus',['id'=>$payment->id])
                                            {{ route('deletelicense',['id'=>$payment->id]) }}

v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})
v-on:click=changeStatus({{$payment->id}},{{$payment->is_approved}})

                                            --}}


                        <a class="response"  v-on:click="changeActiveStatus({{$payment->id}})" href="javascript:void(0)" id="Approved"  > {{ __('Approve') }} </a>

                                            |






                                            <a class="response" v-on:click="changeDeactiveStatus({{$payment->id}})" href="javascript:void(0)" id="Disapprove"  > {{ __('Disapprove') }} </a>

                                        </td> -->
                    </tr>

                @endforeach

                </tbody>
            </table>

            <div></div>
        @else
            <div class="alert alert-danger custom_warning_payment" role="alert"><p class="custom_para_results">No
                    Results for your search*</p></div>
@endif
@endif

