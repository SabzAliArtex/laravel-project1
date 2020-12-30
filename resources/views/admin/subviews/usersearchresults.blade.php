@if($formatCheck == 1)
    <table id="tableListing" border="1" class="table table-striped table-responsive-xl">

        <tbody>
        @if($users)
            @foreach($users as $key=> $user)
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $user->first_name.' '.$user->last_name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->userrole->role }} </td>
                    <td> {{ $user->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                    <td>

                        @if($user->role == 3)
                            <a href="{{ route('editsalesperson',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>
                        @else
                            <a href="{{ route('edituser',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>

                        @endif
                        |
                        <a href="{{ route('deleteuser',['id'=>$user->id]) }}"
                           onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>

                    </td>

                </tr>
            @endforeach


        @endif
        </tbody>
    </table>

@else
    <table id="tableListing" class="table table-striped table-responsive">

        <tbody>
        @if(count($users)>0)
            @foreach($users as $key=> $user)

                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $user->first_name.' '.$user->last_name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->role }} </td>
                    <td> {{ $user->is_active == 1 ? 'Active' : 'Inactive' }} </td>

                    <td>

                        @if($user->role == "Sales Person")
                            <a href="{{ route('editsalesperson',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>
                        @else
                            <a href="{{ route('edituser',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>

                        @endif
                        |
                        <a href="{{ route('deleteuser',['id'=>$user->id]) }}"
                           onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>

                    </td>

                </tr>
            @endforeach
        @else
            <tr>
                <div class="alert alert-danger custom_user_search" role="alert"><p class="custom_para_results">No
                        Results for your search*</p></div>
            </tr>


        @endif

        </tbody>
    </table>


@endif
