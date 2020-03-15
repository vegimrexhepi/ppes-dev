<!-- JavaScripts -->
<!-- Application's main Libraries -->
<script src="{{ asset('js/libs/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('js/libs/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/libs/jquery.backstretch.min.js') }}"></script>
<script src="{{ asset('js/libs/sidebarEffects.js') }}"></script>
<script src="{{ asset('js/libs/classie.js') }}"></script>
<script src="{{ asset('js/libs/placeholder.js') }}"></script>
<script src="{{ asset('js/libs/bootstrap-switch.min.js') }}"></script>
<!-- Children libraries -->
@yield('libs')
<!-- Application's main scripts -->
<script src="{{ asset('js/scripts.js') }}"></script>
{{-- Children scripts --}}
@yield('scripts')
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
