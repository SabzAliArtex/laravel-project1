<div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ config('app.name') }}</div>
                <div class="card-body">
                    <li>
                        <a href="{{ route('userslist') }}"> {{ __('All Users') }} </a>
                    </li>
                   <!--  <li>
                        <a href="{{ route('AddUser') }}"> {{ __('Add User') }} </a>
                    </li> -->

                    <li>
                        <a href="{{ route('SalesPersons') }}"> {{ __('Sales Person List') }} </a>
                    </li>
                   <!--  <li>
                        <a href="{{ route('addLicenseType') }}"> {{ __('Add License Types') }} </a>
                    </li> -->
                    <li>
                        <a href="{{ route('licensetypes') }}"> {{ __('License Types') }} </a>
                    </li>

                    <li>
                        <a href="{{ route('licenselist') }}"> {{ __('License List') }} </a>
                    </li>
                   <li>
                        <a href="{{ route('license.multiple') }}"> {{ __('Add Multiple licenses') }} </a>
                    </li>
                     <li>
                        <a href="{{ route('paymentlist') }}"> {{ __('All Commission List') }} </a>
                    </li><li>
                        <a href="{{ route('paymentlistpending') }}"> {{ __('Commission Pending List') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('a') }}"> {{ __('Users Devices Listing') }} </a>
                    </li>
                </div>
            </div>
        </div>
