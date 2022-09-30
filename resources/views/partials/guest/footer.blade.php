<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>

@if (Request::is('auth*'))
  <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap4/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/template/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/template/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/template/js/custom.js') }}"></script>
@else
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endif


@yield('scripts')
</body>

</html>
