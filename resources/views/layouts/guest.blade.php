@include('partials.guest.header')

@if (Request::is('/') || Request::is('about-us'))
  @include('partials.guest.navigation')
@endif

@yield('content')

@include('partials.guest.footer')
