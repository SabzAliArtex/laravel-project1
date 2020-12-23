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
        @include('partials_admin/sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="custom-card-header-span">{{ __('License List') }}</span> <a href="{{ route('createlicense') }}" class="btn btn-info btn-md button-add border border-light " >
          <i class="fas fa-plus"></i>Add License
        </a></div>
                <div class="card-body">
                    @include('partials_general/searchbar')
                    @if(count($licenses) >0)

                    <table id="tableListing" border="1" style="overflow: scroll;"  class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th> 
                                <th> {{ __('License Key') }} </th> 
                                <th> {{ __('License Type') }} </th>
                                <th> {{ __('User Name') }} </th> 
                                <th> {{ __('User Email') }} </th> 
                                <th> {{ __('Sales Person Name') }} </th> 
                                <th> {{ __('Trial Activated At') }} </th> 
                                <th> {{ __('Activated At') }} </th> 
                                <th colspan="2"> {{ __('Actions') }} </th> 
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($licenses as $key=> $license)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
                                        <td> 
                                            @if($license->license_type && $license->license_type->type == '1' )
                                                Monthly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '2' )
                                                Yearly {{ '('. $license->license_type->price . ')' }}
                                            @elseif ($license->license_type &&  $license->license_type->type == '3' )
                                                Life time {{ '('. $license->license_type->price . ')' }}
                                            @endif      
                                        </td>
                                        <td> {{ $license->user ? $license->user->first_name : '' }} </td>
                                        <td> {{ $license->user ? $license->user->email : '' }} </td>
                                        <td> {{ $license->sales_person ? $license->sales_person->first_name.' '.$license->sales_person->last_name : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>

                                        <td colspan="2"> 
                                            <a href="{{ route('editlicense',['license'=>$license->license]) }}"> {{ __('Edit') }}  </a>

                                            |
                                            <a href="{{ route('deletelicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a>
                                        </td>
                                    </tr>

                                @endforeach
                                
                        </tbody>
                    </table>
                    {{$licenses->render()}}
                    @include('partials_general/searchalert')
                    @else
                    <p> *nothing found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
