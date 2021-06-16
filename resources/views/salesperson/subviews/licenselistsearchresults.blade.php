 
<table id="tableListing" border="1"  class="table table-striped table-responsive">
                        
                        <tbody>
                                @forelse($licenses as $key=> $license)
                                    <tr>

                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $license->license }} </td>
                                        <td> 
                                            {{ get_license_type_text($license) }}  
                                        </td>
                                        <td> {{ $license->first_name ? $license->first_name : '' }} </td>
                                        <td> {{ $license->email ? $license->email : '' }} </td>
                                        <td> {{ $license->trial_activated_at }} </td>
                                        <td> {{ $license->license_activated_at }} </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger custom_warning_license_sp" role="alert"><p class="custom_para_results">No Results for your search*</p></div>
                                   
                                    @endforelse
                        </tbody>
                    </table>
                    {{$licenses->render()}}
                 
              