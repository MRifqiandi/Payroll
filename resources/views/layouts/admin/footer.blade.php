<footer class="footer text-center text-muted">
    {{-- All Rights Reserved by ITK. Developed by <a href="https://instagram.com/">h</a>. --}}
</footer>

<script src="{{ asset('src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('src/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('src/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<!-- apps -->
<script src="{{ asset('src/dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('src/dist/js/feather.min.js') }}"></script>
<script src="{{ asset('src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('src/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('src/dist/js/custom.min.js') }}"></script>
<!--Custom JavaScript -->
{{-- <script src="{{asset('src/dist/js/custom.min.js')}}"></script> --}}
<!--This page JavaScript -->
<script src="{{ asset('src/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('src/assets/extra-libs/c3/c3.min.js') }}"></script>
{{-- <script src="{{ asset('src/assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('src/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}">
</script> --}}
<script src="{{ asset('src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('src/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
{{-- <script src="{{ asset('src/dist/js/pages/dashboards/dashboard1.min.js') }}"></script> --}}
<!--This page plugins -->
<script src="{{ asset('src/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('src/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
<script src="{{ asset('src/assets/libs/sweetalert.js') }}"></script>
<script src="{{ asset('src/assets/libs/toastr.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('[data-bs-dismiss="modal"]').on('click', function(e) {
            $(this).closest('.modal').modal('hide');
        });

        $('[data-bs-toggle="modal"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this).data('bs-target');
            $(target).modal('show');
        });

        $('[data-control="select2"]').each(function() {
            const hideSearch = $(this).data('hide-search') === true;
            const placeholder = $(this).data('placeholder') || 'Select an option';
            const select2Parent = $(this).data('select2-parent');

            $(this).select2({
                placeholder: placeholder,
                minimumResultsForSearch: hideSearch ? Infinity : 0,
                dropdownParent: select2Parent ? $(select2Parent) : null,
                width: '100%'
            });
        });
    });
</script>

