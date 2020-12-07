@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Sales Persons') }}</div>
                <div class="card-body">
                    <table border="1" style="width:100%" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('Name') }} </th> 
                                <th> {{ __('Email') }} </th> 
                                <th> {{ __('Comission') }} </th> 
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
                                        <td> {{ $user->commission }} </td>
                                        <td> {{ $user->userrole->role }} </td>
                                        <td> {{ $user->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td> 
                                            <a href="{{ route('editsalesperson',['id'=>$user->id]) }}"> {{ __('Edit') }}  </a>
                                            |
                                            <a href="{{ route('deleteuser',['id'=>$user->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr> </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
