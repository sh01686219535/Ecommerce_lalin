@php
    use Illuminate\Support\Facades\Auth;
@endphp

{{-- <header class="header">
    <a href="{{ url('/') }}" style="text-decoration: none">
        <img src="{{ asset('frontendAsset/images/logo.webp') }}" width="200" height="60">
    </a>
   
    <nav class="nav-links">
        <a href="{{ url('/') }}">Home</a>

        @if (Auth::guard('user')->check())
          
            <a style="margin-right: 10px; color: #000;">
                <strong>{{ Auth::guard('user')->user()->name }}</strong>
            </a>
        @elseif (Auth::guard('vendor')->check())
            <a style="margin-right: 10px; color: #000;">
                <strong>{{ Auth::guard('vendor')->user()->name }}</strong>
            </a>
        @else
            
            <a href="{{ route('user.view') }}">Login-Or-Register</a>
            <a href="{{ route('user.login') }}">Login</a> 
             <a href="{{ route('user.register') }}">Register</a>
           <a href="{{ route('vendor.view') }}">Vendor</a>
            <a href="{{ route('user.view') }}" class="auth-btn">
                Login / Register
            </a>
            <a href="{{ route('vendor.view') }}" class="auth-btn vendor">
                Vendor
            </a>
        @endif


    </nav>
</header> --}}
<header class="top-header">
    <div class="header-container">

        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-shopping-cart cart-icon"></i>
            <div class="logo-text">
                <a href="{{ url('/') }}" style="text-decoration: none">
                    <img src="{{ asset('frontendAsset/images/logo.webp') }}" width="200" height="60">
                </a>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <input type="text" placeholder="Search Product...">
            <button><i class="fas fa-search"></i></button>
        </div>

        <!-- Right Menu -->
        <div class="menu">
            <a href="#"><i class="fas fa-truck"></i> Track Order</a>
            <a href="#"><i class="far fa-user"></i> Login / Sign Up</a>
            <div class="cart">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-count">0</span>
            </div>
        </div>

    </div>
</header>
