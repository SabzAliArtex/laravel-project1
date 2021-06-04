<div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Side Bar') }}</div>
                <div class="card-body">
                    <li> 
                        <a href="{{ route('salesperson.license') }}"> {{ __('All Licenses') }} </a>
                    </li>
                    <li> 
                        <a href="{{ route('salesperson.activelicense') }}"> {{ __('Activated Licenses') }} </a>
                    </li>
                </div> 
            </div>       
        </div>