<!DOCTYPE html>
<html>

<head>
    <title>Prescription Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{url('asset/css/custom.css')}}" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="#">PMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(Auth::user()->role == 'user')
                        <li class="nav-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
                            <a class="nav-link text-info" href="{{ url('/user/dashboard') }}">Upload Prescription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info {{ request()->is('user/prescription') || request()->is('user/prescription/*') ? 'active' : '' }}" href="{{ route('user.prescription.view') }}">My Prescriptions</a>
                        </li>
                    @endif
                    @if(Auth::user()->role == 'pharmacy')
                        <li class="nav-item">
                            <a class="nav-link text-success {{ request()->is('pharmacy.prescriptions.index') || request()->is('pharmacy/prescriptions/index/*') ? 'active' : '' }}" href="{{ route('pharmacy.prescriptions.index') }}">Uploaded Prescriptions</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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


    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-secondary text-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-warning text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">PMS</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                @if(Auth::user()->role == 'user')
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="nav-link text-info {{ request()->is('user/dashboard') ? 'active' : '' }}">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#speedometer2" />
                            </svg>
                            Upload Prescriptions
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 'pharmacy')
                    <li class="nav-item">
                        <a href="{{ route('pharmacy.prescriptions.index') }}" class="nav-link text-success {{ request()->is('pharmacy/prescriptions') || request()->is('pharmacy/prescriptions/*') ? 'active' : '' }}" aria-current="page">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#home" />
                            </svg>
                            Uploaded Prescriptions
                        </a>
                    </li>
                @endif
                @if(Auth::user()->role == 'user')
                    <li class="nav-item">
                        <a href="{{ route('user.prescription.view') }}" class="nav-link text-info {{ request()->is('user/quotations') || request()->is('user/quotations/*') ? 'active' : '' }}" aria-current="page">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#home" />
                            </svg>
                            My Prescriptions
                        </a>
                    </li>
                @endif
            </ul>
            <hr>
        </div>

        <div class="container bg-light text-dark p-4 rounded">
            @yield('content')
        </div>
    </main>


    </div>
    </div>


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

</html>