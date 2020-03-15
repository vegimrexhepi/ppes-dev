<!DOCTYPE html>
<html lang="en">
    @include('partials.header')

    <body id="app-layout">

        @section('content-wrapper')
            {{-- Navigation --}}
            @include('partials.navigation-student')

            @yield('content')
        @show

        @section('footer-wrapper')
            {{-- @include('partials.footer') --}}
        @show

        @include('partials.scripts')
    </body>
</html>
