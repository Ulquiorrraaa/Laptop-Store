<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LappyToppy - Premium Electronics')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

   <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
</head>
<body>

    <nav>
        <div class="container">
            <a href="/" class="logo">💻 Lappy<span>Toppy</span></a>
            
            <ul>
                <li>
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="/admin/products" class="{{ request()->is('admin/products*') ? 'active' : '' }}">Products</a>
                        </li>
                        <li>
                            <a href="/admin/orders" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">Orders</a>
                        </li>
                        <li>
                            <a href="/admin/users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">Users</a>
                        </li>
                    @else
                        <li>
                            <a href="/customer/dashboard" class="{{ request()->is('customer/dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="/orders" class="{{ request()->is('orders*') ? 'active' : '' }}">My Orders</a>
                        </li>
                        <li>
                            <a href="/cart" class="{{ request()->is('cart') ? 'active' : '' }}">Cart 🛒</a>
                        </li>
                        <li>
                            <a href="/customer/profile" class="{{ request()->is('customer/profile') ? 'active' : '' }}">Profile</a>
                        </li>
                    @endif
                    
                    <li>
                        <form action="/logout" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-btn-logout">Logout</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="/login" class="{{ request()->is('login') ? 'active' : '' }}">Login</a>
                    </li>
                    <li>
                        <a href="/register" class="{{ request()->is('register') ? 'active' : '' }}" style="color: var(--primary); font-weight: bold;">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">✨ {{ session('success') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">⚠️ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} <strong>LappyToppy</strong>. Premium Laptops for Professionals.</p>
        </div>
    </footer>

</body>
</html>