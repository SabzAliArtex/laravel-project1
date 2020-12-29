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
                    <div class="card-header">
                        <span class="custom-card-header-span-settings">{{ __('Application Settings') }}</span>
                        </div>   <div class="card-body" id="card-check">
                       {{-- <div class="row custom_row_position ">
                            <div class="col-md-12 input-group mb-3">
                                @include('partials_general/searchbar')
                            </div>
                        </div>--}}

                        <table id="tableListing"  border="1" width="100%"  class="table table-striped table-responsive">
                            <thead class="thead-dark">
                            <tr id="pRow">
                                <th> {{ __('Sr no') }} </th>
                                <th id="thname"> {{ __('App Name') }} </th>
                                <th style="width: 1% !important;"> {{ __('App Env') }} </th>
                                <th> {{ __('App URL') }} </th>
                                <th> {{ __('App Key') }} </th>
                                <th> {{ __('App DEBUG') }} </th>
                                <th colspan="2">  {{ __('Actions') }} </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                @foreach($settings as $key=> $row)
                                <td>{{$key + 1}}</td>
                                <td>{{$row->app_name}}</td>
                                <td>{{$row->app_env}}</td>
                                <td>{{$row->app_url}}</td>
                                <td>{{$row->app_key}}</td>
                                <td>{{$row->app_debug}}</td>
                                <td><a class="btn btn-default btn-dark btn-md" href="{{route('editsettings',['id'=>$row->id])}}"><i class="fa fa-pencil"> Edit</i></a></td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('#myInput').on('keyup',function(){
                $value=jQuery(this).val();
                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('users-search-results')}}',
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
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        jQuery.noConflict();
        jQuery(document).ready(function(){
            jQuery('.search-filter').on('change',function(){
                $value=jQuery(this).val();
                console.log($value);
                jQuery.ajax({
                    type : 'get',
                    url : '{{URL::to('users-search-results')}}',
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
