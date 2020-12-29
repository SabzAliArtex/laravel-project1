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
                <div class="card-header"><span class="custom-card-header-span">{{ __('Sales Person') }}</span> <a href="{{ route('AddUser') }}" class="btn btn-info btn-md button-add border border-light " >
          <i class="fas fa-plus"></i>Add Sales Person
        </a></div>
                <div class="card-body">
                    <div class="row custom_row_position ">
                        <div class="col-md-12 input-group mb-3">
                    @include('partials_general/searchbar')
                        </div>
                    </div>

                    <table id="tableListing" border="1" style="width:100%" class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th> {{ __('Sr no') }} </th>
                                <th id="thname"> {{ __('Name') }} </th>
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
                    @include('partials_general/searchalert')
                    <?php echo $users->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    // Your jquery code
     jQuery.noConflict();
    jQuery(document).ready(function(){
 jQuery('#myInput').on('keyup',function(){
$value=jQuery(this).val();
jQuery.ajax({
type : 'get',
url : '{{URL::to('sales-persons-search')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
document.getElementById("thname").style.width="1%";
}
});
});
});
 jQuery.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
});


</script>
