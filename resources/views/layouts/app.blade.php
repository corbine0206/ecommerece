<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            padding-top: 20px;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: #ffffff;
        }
        .main-content {
            padding-top: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            text-align: center;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Navigation) -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Dashboard
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users') }}">
                                Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                Manage Products
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}">
                                    View Cart
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.products.index') }}">
                                    View Products
                                </a>
                            </li>
                        @endif
                    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-4 main-content">
            @auth
                @if(auth()->user()->role === 'admin')
                    <h2 class="my-4">Admin Dashboard</h2>
                    @yield('content') <!-- Admin dashboard content here -->
                @elseif(auth()->user()->role === 'user')
                    <h2 class="my-4">User Dashboard</h2>
                    @yield('content') <!-- User dashboard content here -->
                @endif
            @else
                <h2 class="my-4">Welcome to the Platform</h2>
                @yield('content') <!-- Guest content like login/register goes here -->
            @endauth
        </main>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
</div>

<!-- Bootstrap JS and Popper.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Logout Form (hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

</body>
</html>
