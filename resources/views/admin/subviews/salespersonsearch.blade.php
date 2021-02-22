
    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive">

        <tbody>
        
            @forelse($users as $key=> $user)
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $user->first_name.' '.$user->last_name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->commission }} </td>
                    <td> {{ $user->role }} </td>
                    <td> {{ $user->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                    <td>
                        <a href="{{ route('editsalesperson',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>
                        |
                        <a href="{{ route('deleteuser',['id'=>$user->id]) }}"
                           onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                    </td>
                </tr>
                @empty
                <div class="alert alert-danger custom_warning_sales" role="alert"><p class="custom_para_results">No Results for your search*</p>
                @endforelse
        </tbody>

    </table>
    