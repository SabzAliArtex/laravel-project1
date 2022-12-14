<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js" integrity="sha512-eviLb3jW7+OaVLz5N3B5F0hpluwkLb8wTXHOTy0CyNaZM5IlShxX1nEbODak/C0k9UdsrWjqIBKOFY0ELCCArw==" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @toastr_css
    @toastr_js

    <style type="text/css">

.example {
  background-color: #eee;
  width: 200px;
  height: 100px;
  border: 1px dotted black;
  overflow-x: scroll; /* Add the ability to scroll */
}

/* Hide scrollbar for Chrome, Safari and Opera */
.example::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.example {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth
                    @php
                        if(Auth::user()->role == 1)
                            $route = 'admin.home';
                        elseif (Auth::user()->role == 2)
                            $route = 'user.home';
                        else
                            $route = 'salesperson.home';
                    @endphp
                @else
                    @php
                        $route = 'welcome';
                    @endphp
                @endauth
                <a class="navbar-brand" href="{{ route($route) }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == 1)
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                      <!--   <a class="dropdown-item" href="{{ route('settings') }}">
                                        {{ __('Settings') }}
                                    </a> -->
                                    @elseif (Auth::user()->role == 2)
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    @else
                                    <a class="dropdown-item" href="{{ route('salesperson.profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            
            @yield('content')
        </main>
    </div>

</body>
</html>


<!-- use later if we want to filter records in a table
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue,check;
  check = false;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tableListing");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
 if (td) {
      txtValue = td.textContent || td.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
        check = true;
        tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
 }
 }
  }
    document.getElementById("searchalert").style.visibility = check ? 'hidden' : 'visible';
   /* if(!check){
        setTimeout(function() {
       document.getElementById("searchalert").style.visibility = 'hidden';

    }, 25000)
      }*/

}

</script> -->

