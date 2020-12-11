<div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Side Bar') }}</div>
                <div class="card-body">
                    <li> 
                        <a href="{{ route('userslist') }}"> {{ __('All Users') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('AddUser') }}"> {{ __('Add User') }} </a>
                    </li>

                    <li> 
                        <a href="{{ route('SalesPersons') }}"> {{ __('Sales Person List') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('addLicenseType') }}"> {{ __('Add License Types') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('licensetypes') }}"> {{ __('License Types') }} </a>
                    </li>

                    <li> 
                        <a href="{{ route('licenselist') }}"> {{ __('License List') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('createlicense') }}"> {{ __('Add license') }} </a>
                    </li>
                </div> 
            </div>       
        </div>