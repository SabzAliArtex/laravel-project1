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
        </div>
        <div class="row" id="details">
            @include('layouts.partials_admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('User Devices Listing') }}</div>
                    <div class="card-body">

                        <div class="row custom_row_position ">
                            <div class="col-md-12 input-group mb-3">
                                @include('partials_general/searchbar')
                            </div>
                        </div>
                        
                            <table id="tableListing" border="1" class="table table-striped table-responsive">
                                <thead class="thead-dark">
                                <tr>
                                    <th> {{ __('Sr no') }} </th>
                                    <th> {{ __('License Key') }} </th>
                                    <th> {{ __('License Type') }} </th>
                                    <th> {{ __('User Name') }} </th>
                                    <th> {{ __('User Email') }} </th>
                                    <th> {{ __('Device Id') }} </th>
                                    <th> {{ __('Status') }} </th>
                                <!-- <th colspan="2" > {{ __('Action') }} </th> -->

                                </tr>
                                </thead>
                                <tbody>
                                        
                                @forelse($licenses as $key=> $license)
                                    <tr>

                                        <td> {{ $key + 1 }} </td>

                                        <td> {{ $license->license}} </td>
                                        <td>
                                            @if($license->license_type_id == '1' )
                                                Monthly {{ '('. $license->price . ')' }}
                                            @elseif ( $license->license_type_id == '2' )
                                                Yearly {{ '('. $license->price . ')' }}
                                            @elseif ( $license->license_type_id == '3' )
                                                Life time {{ '('. $license->price . ')' }}
                                            @endif
                                        </td>
                                        <td> {{ $license->first_name ? $license->first_name : 'N\A' }} </td>
                                        <td> {{ $license->email ? $license->email : 'N\A' }} </td>
                                        <td>{{$license->device_id}}</td>
                                        
                                        <td> @if($license->is_deleted == 1) Deleted
                                            @else
                                                Not Deleted
                                        @endif
                                        {{--          </td>


                                                      <td><a href="{{ route('user.deleteuserlicense',['id'=>$license->id]) }}" onclick="return confirm('Are you sure.')"> {{ __('Delete') }}  </a></td>
                                                      <td><a @click="openDetailModal({{$license->id}})" href="#"> {{ __('Details') }}  </a></td>--}}

                                    </tr>
                                    @empty
                                    <p> *nothing found</p>
                                @endforelse
                                </tbody>
                            </table>
                            @include('partials_general/searchalert')

                    <!-- The Modal -->
                        {{-- <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">All Licenses</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <table class="table table-striped table-responsive custom-scroll">
                                            <thead>
                                            <tr>
                                                <th> {{ __('Sr no') }} </th>
                                                <th> {{ __('License Key') }} </th>
                                                <th> {{ __('License Type') }} </th>
                                                <th> {{ __('User Name') }} </th>
                                                <th> {{ __('User Email') }} </th>
                                                <th> {{ __('Device Name') }} </th>
                                                <th> {{ __('Device Os') }} </th>
                                                <th colspan="2"> {{ __('Action') }} </th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(row,key,index) in alldata" :key="row.id">
                                                <td>@{{key+1}}</td>
                                                <td>@{{row.device_license[0].license}}</td>
                                                <td>
                                                    <div v-if="row.license_type && row.license_type.type==1">
                                                        Monthly(@{{row.license_type.price}})
                                                    </div>
                                                    <div v-if="row.license_type && row.license_type.type==2">
                                                        Yearly(@{{row.license_type.price}})
                                                    </div>
                                                    <div v-if="row.license_type && row.license_type.type==3">
                                                        Lifetime(@{{row.license_type.price}})
                                                    </div>
                                                </td>
                                                <td>@{{row.users[0].first_name}}</td>
                                                <td>@{{row.users[0].email}}</td>
                                                <td>@{{row.device_name}}</td>
                                                <td>@{{row.device_os}}</td>

                                                <td><a href="javascript:void(0)"
                                                       @click="deleterecordandfetchagain(row.id)"> {{ __('Delete') }}  </a>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


{{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    window.onload = function () {
        var vm = new Vue({

            el: '#details',
            data: {
                alldata: {},
                licid: '',
                message: 'Hello vue',
            },
            methods: {
                openDetailModal: function (licenseid) {
                    axios.get('/user/getuserdetails/' + licenseid).then((res) => {
                        this.licid = licenseid;
                        console.log(this.licid);
                        this.alldata = res.data;

                        $('#myModal').modal('show');
                    }).catch((error) => {

                    })


                },
                deleterecordandfetchagain: function (id) {
                    if (confirm("Are you sure? Your data will be deleted")) {
                        console.log(this.licid);
                        axios.get('/user/deletelicense/' + id)
                            .then((res) => {
                                this.openDetailModal(this.licid);


                            })
                    } else {
                        return false;
                    }
                },


            },
            mounted() {


            }

        })
    }

</script> --}}
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Your jquery code
        jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery('#myInput').on('keyup', function () {
                
                $value = jQuery(this).val();
                jQuery.ajax({
                    type: 'get',
                    url: '{{URL::to('getuseranddevices-search-results')}}',
                    data: {'search': $value},
                    success: function (data) {
                        $('tbody').html(data);
                    }
                });
            });
        });
        jQuery.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    });


</script>
