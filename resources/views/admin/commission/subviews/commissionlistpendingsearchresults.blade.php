@if(count($payments) >0)
    <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"
           class="table table-striped table-responsive ">

        <tbody>

        @foreach($payments as $key=> $payment)
            <tr>
                <td class="ellipsis"> {{ $key+1 }} </td>
                <td class="ellipsis"> {{ $payment->license_id }} </td>
                <td class="ellipsis">{{$payment->sales_person_id}}</td>
                <td class="ellipsis">{{$payment->commission}}</td>
        @if($payment->is_approved == 0)
                <td class="ellipsis ">Pending</td>
        @endif
                <td class="ellipsis">{{$payment->first_name}}</td>
                <td colspan="2">
                <a class="response Approvedr" id="Approved" data-value="{{$payment->id}}"
                href="javascript:void(0)"> {{ __('Approve') }}  
                </a>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>
        
    </div>
@else
    <div class="alert alert-danger custom_warning_pending_commission" role="alert"><p class="custom_para_results">No
            Results for your search*</p></div>
@endif

