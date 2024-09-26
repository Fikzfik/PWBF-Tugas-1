<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Skrip Vendor dan Plugin -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

<!-- Inject JS -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<!-- Kode untuk inisialisasi Bootstrap collapse sidebar -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var collapses = document.querySelectorAll('.collapse');

    collapses.forEach(function (collapse) {
        var bsCollapse = new bootstrap.Collapse(collapse, {
            toggle: false
        });
    });

    // If you want to handle clicks manually
    document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default behavior
            var targetId = el.getAttribute('href');
            var targetElement = document.querySelector(targetId);
            var bsCollapse = new bootstrap.Collapse(targetElement);
            bsCollapse.toggle();
        });
    });
});

</script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<!-- Kode Kustom -->
<script src="{{ asset('assets/js/baru.js') }}"></script>
