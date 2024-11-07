<div class="modal fade" id="modal_reset_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack align-items-center">
                <div class="fs-2 fw-bold">Reset Password</div>

                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <form class="modal-body pt-10 pb-15 px-lg-17" id="form_reset_password">
                <div class="px-3" style="max-height: 400px; overflow-y: auto;">
                    <input type="text" name="id" hidden>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span>Nama</span>
                        </label>
                        <div class="form-control form-control-lg form-control-solid" id="name"></div>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span>Email</span>
                        </label>
                        <div class="form-control form-control-lg form-control-solid" id="email"></div>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Password</span>
                        </label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="password" required
                            placeholder="" value="">
                    </div>
                </div>

                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                        <span class="indicator-label">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#form_reset_password').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $('#form_reset_password [type="submit"]').attr('disabled', true);
            $('#form_reset_password [type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
            $.ajax({
                url: "{{ route('account.update.password') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    $('#form_reset_password [type="submit"]').attr('disabled', false);
                    $('#form_reset_password [type="submit"]').html('Simpan');
                    $('#form_reset_password').trigger('reset');
                    $('#modal_reset_password').modal('hide');

                    accountTable?.draw();
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                    $('#form_reset_password [type="submit"]').attr('disabled', false);
                    $('#form_reset_password [type="submit"]').html('Simpan')
                }
            });
        });
    });
</script>
