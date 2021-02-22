<div id="paymentStatus">
    
        
            <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"
                   class="table table-striped table-responsive-xl ">

                <tbody>

                @forelse($payments as $key=> $payment)
                    <tr>

                        <td> {{ $key+1 }} </td>
                        <td> {{ $payment->license_id }} </td>
                        <td>{{$payment->sales_person_id}}</td>
                        <td id="thn">{{$payment->commission}}</td>
                        @if($payment->is_approved == 1)
                            <td>Approved</td>
                        @else
                            <td>Pending</td>
                        @endif
                        <td>{{$payment->first_name}}</td>
                    </tr>
                    @empty
                    <div class="alert alert-danger form-control-lg payment-search" role="alert"><p class="custom_para_results">No
                        Results for your search*</p></div>
                @endforelse

                </tbody>
            </table>


            <div></div>
