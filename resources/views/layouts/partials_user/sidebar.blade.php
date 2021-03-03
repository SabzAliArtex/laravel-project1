<div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Side Bar') }}</div>
                <div class="card-body">
                    <li> 
                        <a href="{{ route('user.profile') }}"> {{ __('Profile') }} </a>
                    </li>
                   

                    <li> 
                        <a href="{{ route('user.activelicense') }}"> {{ __('License List') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('user.purchasehistory') }}"> {{ __('Purchase History') }} </a>
                    </li>
                    
                </div> 
            </div>       
        </div>