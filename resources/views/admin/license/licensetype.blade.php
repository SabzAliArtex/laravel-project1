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
                <div class="card-header">{{ __('License Types') }}</div>
                <div class="card-body">
                    @if(count($license_types) >0)
                    <table border="1" style="width:100%" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('Title') }} </th> 
                                <th> {{ __('Price') }} </th> 
                                <th> {{ __('Type') }} </th> 
                                <th> {{ __('Allowd Tests') }} </th> 
                                <th> {{ __('Status') }} </th> 
                                <th> {{ __('Actions') }} </th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($license_types as $key=> $license_type)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license_type->title }} </td>
                                        <td> {{ $license_type->price }} </td>
                                        <td> 
                                            @if( $license_type->type == '1' )
                                                Monthly
                                            @elseif ( $license_type->type == '2' )
                                                Yearly
                                            @elseif ( $license_type->type == '3' )
                                                Life time
                                            @endif      
                                        </td>
                                        <td> 
                                            @php 
                                                $allowed_tests = json_decode($license_type->allowed_test);
                                                if(count($allowed_tests) > 0){
                                                    echo implode(" , ", $allowed_tests);
                                                }
                                            @endphp
                                        </td>
                                        <td> {{ $license_type->is_active == 1 ? 'Active' : 'Inactive' }} </td>
                                        <td> 
                                            <a href="{{ route('editlicensetype',['id'=>$license_type->id]) }}"> {{ __('Edit') }}  </a>
                                            |
                                            <a href="{{ route('deletelicensetype',['id'=>$license_type->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                    <p> *nothing found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection