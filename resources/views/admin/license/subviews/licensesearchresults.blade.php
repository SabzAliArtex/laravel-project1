
    

        <table id="tableListing" border="1" style="overflow: scroll;" class="table table-striped table-responsive">

            <tbody>
            @forelse($licenses as $key=> $license)
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $license->license }} </td>
                    <td>
                        
                        @if(isset($license->license_type) && $license->license_type->type == '1')
                            Monthly {{ '('. $license->license_type->price . ')' }}
                        @elseif($license->type && $license->type == '1' )
                            Monthly {{ '('. $license->price . ')' }} 
                        @endif
                       @if (isset($license->license_type) &&  $license->license_type->type == '2'  )
                            Yearly {{ '('. $license->license_type->price . ')'}}
                        @elseif($license->type &&  $license->type == '2')
                          Yearly {{  '('. $license->price . ')' }}
                        @endif
                        @if (isset($license->license_type) &&  $license->license_type->type == '3'  )
                            Life time {{'('. $license->license_type->price . ')' }}
                        @elseif($license->type &&  $license->type == '2')
                            
                            Life time {{ '('. $license->price . ')' }}

                        @endif
                    </td>
                    <td> {{ isset($license->user) ? $license->user->first_name : $license->first_name }} </td>
                    <td> {{ isset($license->user) ? $license->user->email : $license->email }} </td>
                    <td> {{ isset($license->sales_person) ? $license->sales_person->first_name.' '.$license->sales_person->last_name : $license->fname.' '.$license->lname  }} </td>
                    <td> {{ $license->trial_activated_at }} </td>
                    <td> {{ $license->license_activated_at }} </td>

                    <td colspan="2">
                        <a href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>

                        |
                        <a href="{{ route('deletelicense',['id'=>$license->id]) }}"
                           onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                    </td> 
                </tr>
 @empty
        <div class="alert alert-danger form-control-lg license-search" role="alert"><p class="custom_para_results">No Results for your
                search*</p></div>
            @endforelse

            </tbody>
        </table>


   