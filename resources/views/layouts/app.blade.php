<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Online Bookstore')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="brand-section">
                <a href="{{ route('home') }}">
                    <i class="fas fa-book-open brand-icon"></i>
                    <span>LitHub Bookstore</span>
                </a>
            </div>

            <div class="nav-links">
                @guest
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                @endguest

                @auth
                    @if(Auth::user()->role === 'Author')
                        <a href="{{ route('author.dashboard') }}" class="nav-link"><i class="fas fa-chart-line"></i> Dashboard</a>
                        <a href="{{ route('author.publish.form') }}" class="nav-link"><i class="fas fa-plus"></i> Publish a Book</a>
                    @elseif(Auth::user()->role === 'Customer')
                        <a href="{{ route('cart.view') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> My Cart</a>
                        <a href="{{ route('user.books') }}" class="nav-link"><i class="fas fa-book-reader"></i> Purchased</a>
                    @endif

                    <a href="{{ route('notifications.view') }}" class="nav-link"><i class="fas fa-bell"></i> Notifications</a>
                    <a href="{{ route('support.view') }}" class="nav-link"><i class="fas fa-headset"></i> Support</a>
                    <a href="{{ route('profile') }}" class="nav-link"><i class="fas fa-user-circle"></i> Profile</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content Injection -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: white; border-top: 1px solid var(--border); padding: 40px 20px; margin-top: auto;">
        <div class="container text-center">
            <h4 style="margin-bottom: 16px;"><i class="fas fa-book-open text-muted"></i> LitHub Bookstore</h4>
            <p class="text-muted" style="max-width: 500px; margin: 0 auto; font-size: 0.9rem;">
                © {{ date('Y') }} LitHub. Re-engineered seamlessly into Laravel. Empowering global readers and dynamic authors.
            </p>
        </div>
    </footer>

</body>
</html>
