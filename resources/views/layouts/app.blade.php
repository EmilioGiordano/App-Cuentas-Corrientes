<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'Laravel'))</title>


     <!-- CSS -->
     @yield('css')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/delete-button.js', 'resources/css/datatable.css'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @auth
                <a class="navbar-brand" href="{{ url('/') }}">
                    Inicio
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- LINK NAV BAR A EMPLEADOS -->
                    <ul class="navbar-nav me-auto">
                        
                       

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients.index') }}">{{ __('Clientes') }}</a>    
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('checking-accounts.index') }}">{{ __('Cuentas ') }}</a>    
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('fiscal-conditions.index') }}">{{ __('Condiciones Fiscales') }}</a>    
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">{{ __('Servicios') }}</a>    
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invoices.index') }}">{{ __('Facturas C') }}</a>    
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('payments.index') }}">{{ __('Pagos') }}</a>    
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('receipts.index') }}">{{ __('Recibos de pagos') }}</a>    
                        </li>
                        @endauth
                    </ul>
                      <ul class="navbar-nav me-auto">
                    </ul>

                    <ul class="navbar-nav me-auto">
                    </ul>
                 
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Crear cuenta') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('NewPassword') }}">
                                            {{ __('Edit Profile') }}
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
    </div>
    @yield('js')
</body>
</html>
