
    
        <table id="tableListing" border="1" class="table table-striped table-responsive">

            <tbody>

            @forelse($licenses as $key=> $license)
            <tr>

                <td> {{ $key + 1 }} </td>

                <td> {{ $license->license}} </td>
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
                <td>{{$license->device_id}}</td>
                
                <td> @if($license->is_deleted == 1) Deleted
                    @else
                        Not Deleted
                @endif
                {{--          </td>


                              <td><a class="btn btn-sm btn-primary" href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                              <td><a class="btn btn-sm btn-danger" @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>--}}

            </tr>
            @empty 
             <div class="alert alert-danger custom_warning_userdevs" role="alert"><p class="custom_para_results">No Results
                for your search*</p></div>
            @endforelse
            </tbody>
        </table>


   


