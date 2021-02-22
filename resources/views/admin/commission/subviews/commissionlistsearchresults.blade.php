<div id="paymentStatus">
    @if($formatCheck == 1)
        @if(count($payments) >0)
            <table id="tableListing" border="1" style="width:100%;table-layout: fixed;"
                   class="table table-striped table-responsive-xl ">

                <tbody>

                @foreach($payments as $key=> $payment)
                    <tr>

                        <td> {{ $key+1 }} </td>
                        <td> {{ $payment->license_id }} </td>
                        <td>{{$payment->sales_person_id}}</td>
                        <td>{{$payment->commission}}</td>
                        @if($payment->is_approved == 1)
                            <td>Approved</td>
                        @else
                            <td>Pending</td>
                        @endif
                        <td>{{$payment->sales_person->first_name}}</td>
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

                        <td> {{ $key+1 }} </td>
                        <td> {{ $payment->license_id }} </td>
                        <td>{{$payment->sales_person_id}}</td>
                        <td>{{$payment->commission}}</td>

                        @if($payment->is_approved == 1)
                            <td>Approved</td>
                        @else

                            <td>Pending</td>
                        @endif
                        <td>{{$payment->first_name}}</td>
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

