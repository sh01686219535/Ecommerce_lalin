@include('frontend.include.style')

<body>
    
    @include('frontend.include.header')
    @include('frontend.include.menu')
    @yield('content')
    @include('frontend.include.footer')
    @include('frontend.include.script')

