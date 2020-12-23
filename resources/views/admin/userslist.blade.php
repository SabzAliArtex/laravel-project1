@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>  
        @include('partials_admin/sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="custom-card-header-span">{{ __('Users List') }}</span> <a href="{{ route('AddUser') }}" class="btn btn-info btn-md button-add border border-light  " >
          <i class="fas fa-plus"></i>Add User
        </a></div>
                <div class="card-body">
                @include('partials_general/searchbar')
                   <table id="tableListing" border="1"  class="table table-striped table-responsive-xl">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('Name') }} </th> 
                                <th> {{ __('Email') }} </th> 
                                <th> {{ __('Role') }} </th> 
                                <th> {{ __('Status') }} </th> 
                                <th> {{ __('Actions') }} </th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if($users)
                                @foreach($users as $key=> $user)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $user->first_name.' '.$user->last_name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->userrole->role }} </td>
                                        <td> {{ $user->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td >
                                        
                                            @if($user->role == 3)
                                            <a href="{{ route('editsalesperson',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a >  
                                             @else 
                                                <a href="{{ route('edituser',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>
                                            
                                            @endif
                                            |
                                            <a href="{{ route('deleteuser',['id'=>$user->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                            
                                        </td>

                                    </tr>
                                @endforeach


                            @endif
                        </tbody>
                    </table>
                      <span class="alert alert-danger form-control custom_span_search_results" id="searchalert" ><p class="custom_p">No Records to show*</p></span>
                    <?php echo $users->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

