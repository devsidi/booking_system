<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <title>Booking</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <!--for datepicker-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css\app.css') }}" rel="stylesheet">
    <!--for datepicker-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
</head>
<body>
    <div id="page-container">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container logo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/img/fomemaIOT.png" class="logo" id="logo" alt="" style="height: auto;
                        width: 120px;">
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                                {{-- contact us  --}}
                            
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                        @else
                            <li class="nav-item">
                                @if (Auth::user()->role->name=="admin")
                                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                                @endif
                                @if (Auth::user()->role->name=="customer")
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                @endif
                            </li>
                            @if (Auth::user()->role->name=="customer")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/myBooking') }}">My Booking</a>
                                </li>
                            @endif
                            {{-- @if (Auth::user()->role->name=="doctor")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/appointment') }}">Appointment</a>
                                </li>
                            @endif --}}
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/user-profile') }}">
                                        Profile
                                    </a>
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
        <div class="hidden-xs">
            <footer class="fixed-bottom" class="page-footer font-small stylish-color-dark pt-4" id="footer">
                <div class="container text-center text-md-left">
                <div class="row hide-for-small">
                    <div class="col medium-6 small-12 large-6"  ><br>
                    <div class="col-inner"  >
                        <p style="text-align:center;">Copyright 2021 © <strong>FOMEMA IOT Sdn. Bhd. </strong>All Rights Reserved.</p>
                    </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
    <script>

    $( function() {
        $("#datepicker").datepicker({
            dateFormat:"dd-mm-yy",
            // beforeShowDay: $.datepicker.noWeekends,
            beforeShowDay: function (date)
	{
		return [date.getDay() == 1 || date.getDay() == 2 || date.getDay() == 3 || date.getDay() == 4 || date.getDay() == 5, ''];
	},
           // dayNamesMin: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'],
            inline: true,
            minDate:-3,
        //    value:,
            defaultDate:null,
            onSelect: function(dateText) {
                display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
                $(this).change();
            }
        }).on("change", function() {
                display("Change event");
            });
    
        function display(msg) {
        }
    });
    
    </script>
        @stack('script')
    <style type="text/css">
        #page-container {
        position: relative;
        min-height: 100vh;
        }
        #content-wrap {
        padding-bottom: 2.5rem;    /* Footer height */
        }
        #footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 2.5rem;            /* Footer height */
        }
        label.btn span{ 
            display: inline-block;
            min-width: 60px;
        }  
    </style>
</body>
</html>
