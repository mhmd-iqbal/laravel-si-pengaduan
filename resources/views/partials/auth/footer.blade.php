<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; QHOMEMART {{ date('Y') }}
  </div>
  <div class="footer-right">
    v1.0.0
  </div>
</footer>
</div>
</div>

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap4/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/template/js/stisla.js') }}"></script>
<script src="{{ asset('assets/template/js/scripts.js') }}"></script>
<script src="{{ asset('assets/template/js/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/trix-editor/trix.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>

@yield('scripts')
</body>

</html>
