<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
                    
            #whatsicon {
                fill: #00DFA2;
            }

            #whatsicon:hover {
                fill: #00C4FF;
            }
    </style>
    @stack('style')
</head>
<body>
    <div id="app">
        <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <img src="{{asset('images/logo.png')}}" width="100" height="100" alt="logo">
                &nbsp; &nbsp; &nbsp; &nbsp;
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Student Consultation Board') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
	                    @if (Route::has('login'))
                	            @auth
								<li class="nav-item">
                			        <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">{{ __('Home') }}</a>
                           		</li>
        	                    @endauth
	                    @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
						<li class="nav-item">
							<div class="top-right links">
							@guest
								@if (Route::has('login'))
        	                        <a aria-current="page" href="{{ route('login') }}">{{ __('Login') }}</a>
								@endif
                        	    @if (Route::has('register'))
        	                        <a aria-current="page" href="{{ route('register') }}">{{ __('Register') }}</a>
	                            @endif
							@endguest
  		                	</div>
                  		</li> 
                        @auth
                            <li class="nav-item dropdown end">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-11 my-12 border-top">
    <div class="col-md-6 d-flex align-items-center">  
      <span class="mb-2 mb-md-0 text-body-secondary">&copy; Consult U 2023</span>
      &nbsp; &nbsp;
      <span class="mb-4 mb-md-0 text-body-secondary">&copy; All rights reserved.</span>
    </div>

    <ul class="nav col-md-3 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-body-secondary" href="https://wa.me/380635772631">
      <svg height="40px" width="40px" version="1.1" id="whatsicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512 512" xml:space="preserve">
<path d="M255.999,512c-25.934,0-51.961-4.332-77.361-12.875c-7.966-2.68-12.251-11.309-9.571-19.274
	c2.678-7.966,11.305-12.254,19.274-9.571c22.267,7.49,45.03,11.286,67.659,11.286c124.377,0,225.565-102.089,225.565-227.572
	c0.002-123.271-101.637-223.56-226.568-223.56c-123.823,0-224.563,100.289-224.563,223.56c0,43.274,11.989,85.16,34.672,121.139
	l5.913,8.87c2.442,3.666,3.179,8.211,2.015,12.46l-16.162,59.025l60.92-15.584c8.144-2.086,16.43,2.829,18.514,10.97
	c2.083,8.143-2.829,16.431-10.97,18.514l-86.28,22.072c-5.253,1.344-10.821-0.208-14.622-4.074s-5.259-9.459-3.827-14.687
	l21.243-77.585l-2.173-3.259c-0.068-0.103-0.137-0.208-0.204-0.315C13.65,350.655,0,303.091,0,253.994
	c0-68.07,26.535-131.939,74.717-179.841C122.813,26.334,186.837,0,254.996,0c68.356,0,132.71,26.173,181.205,73.699
	C485.081,121.6,512,185.63,512,253.992c0,68.482-26.824,133.176-75.532,182.162C387.837,485.064,323.745,512,255.999,512z"/>
<path d="M399.217,353.076l4.634-15.273c1.482-4.351-0.274-10.09-4.532-12.685l-67.288-38.073
	c-4.258-2.593-9.905-1.948-13.609,2.217l-30.747,33.223c-2.407,2.036-5.833,2.867-9.072,1.478
	c-11.254-5.064-35.944-16.411-54.297-34.765l0.003-0.003c-0.254-0.25-0.501-0.501-0.753-0.75c-0.25-0.253-0.501-0.499-0.75-0.753
	l-0.003,0.003c-19.138-19.138-29.702-43.043-34.765-54.297c-1.389-3.24-0.558-6.665,1.478-9.072l33.223-30.747
	c4.165-3.704,4.81-9.352,2.217-13.609l-38.073-67.288c-2.593-4.258-8.334-6.014-12.685-4.532l-15.273,4.634
	c-16.384,4.728-31.099,16.026-39.795,32.415c-10.545,21.018-14.054,45.922-2.564,76.283c19.287,51.196,45.82,86.259,66.758,107.196
	c20.937,20.937,56,47.469,107.196,66.758c30.361,11.49,55.263,7.981,76.283-2.564C383.19,384.175,394.489,369.46,399.217,353.076z"
	/>
<path d="M326.998,417.787c-0.002,0-0.003,0-0.005,0c-13.54,0-27.625-2.733-41.862-8.121
	c-56.146-21.153-92.209-49.867-112.57-70.229c-20.362-20.36-49.076-56.423-70.237-112.592c-11.749-31.04-10.673-60.813,3.203-88.47
	c0.052-0.103,0.105-0.207,0.158-0.309c10.239-19.298,28.062-33.826,48.91-39.873l14.993-4.55c2.503-0.817,5.142-1.231,7.847-1.231
	c9.2,0,17.798,4.732,22.439,12.35c0.085,0.14,0.167,0.282,0.25,0.425l37.978,67.12c6.274,10.571,4.141,24.171-5.117,32.519
	l-29.022,26.858c5.2,11.338,14.549,30.101,29.36,45.012c0.119,0.114,0.236,0.228,0.35,0.347l1.28,1.28
	c0.117,0.114,0.233,0.231,0.347,0.35c14.476,14.369,34.119,24.297,45.021,29.354l26.85-29.013
	c5.002-5.548,12.058-8.725,19.388-8.725c4.62,0,9.153,1.246,13.131,3.608l67.12,37.978c0.143,0.081,0.285,0.164,0.425,0.25
	c10.031,6.113,14.774,19.082,11.119,30.285l-4.55,14.995c-6.047,20.849-20.575,38.671-39.873,48.91
	c-0.102,0.055-0.204,0.107-0.309,0.158C358.659,413.98,342.972,417.787,326.998,417.787z M132.651,152.183
	c-9.966,19.968-10.573,40.877-1.853,63.911c20.27,53.803,48.35,86.887,63.286,101.823c14.935,14.935,48.02,43.017,101.801,63.278
	c10.804,4.089,21.264,6.158,31.111,6.158h0.003c11.294,0,22.03-2.617,32.818-8.004c12.012-6.426,21.039-17.53,24.779-30.492
	c0.02-0.067,0.038-0.134,0.059-0.199l3.717-12.25l-60.938-34.48l-28.59,30.893c-0.421,0.455-0.87,0.884-1.344,1.284
	c-4.395,3.714-9.928,5.761-15.584,5.761c-3.209,0-6.342-0.645-9.313-1.919c-0.082-0.035-0.163-0.072-0.245-0.108
	c-10.407-4.682-38.053-17.121-58.813-37.883c-0.078-0.078-0.154-0.155-0.228-0.234l-0.457-0.453
	c-0.043-0.043-0.087-0.087-0.129-0.129l-0.453-0.457c-0.079-0.075-0.157-0.152-0.234-0.228
	c-20.782-20.782-32.152-46.069-37.616-58.222l-0.266-0.592c-0.037-0.082-0.072-0.163-0.108-0.245
	c-3.573-8.33-2.1-17.869,3.844-24.898c0.4-0.473,0.829-0.921,1.283-1.342l30.893-28.59l-34.48-60.938l-12.25,3.717
	c-0.065,0.02-0.132,0.04-0.199,0.059C150.181,131.144,139.077,140.169,132.651,152.183z"/>
</svg>  
      </a></li>
    </ul>
  </footer>
</div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
    @stack('scripts')
</body>
</html>
