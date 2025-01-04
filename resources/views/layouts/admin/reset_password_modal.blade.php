<div class="modal fade" id="modal_reset_password" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack align-items-center">
                <div class="fs-2 fw-bold">Ubah Password</div>

                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <form class="modal-body pt-10 pb-15 px-lg-17" id="form_reset_password">
                <div class="px-3" style="max-height: 400px; overflow-y: auto;">
                    <div id="modal-alert-container" class="mb-3">
                        {{--  --}}
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Password Lama</span>
                        </label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="old_password"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Password Baru</span>
                        </label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="password"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Konfirmasi Password Baru</span>
                        </label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation"
                            required placeholder="" value="">
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
                url: "{{ route('profile.update.password') }}",
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
                    $('#form_reset_password [type="submit"]').html('Simpan')
                    $('#modal_reset_password').modal('hide');

                    $('#form_reset_password').trigger('reset');
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    $('#form_reset_password [type="submit"]').attr('disabled', false);
                    $('#form_reset_password [type="submit"]').html('Simpan')

                    const alert = $(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${data.message}
                            <i class="fa fa-times close-icon" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer;"></i>
                        </div>
                    `);

                    $('#modal_reset_password #modal-alert-container').html(alert);
                    setTimeout(() => {
                        alert.alert('close');
                    }, 5000);
                }
            });
        });
    });
</script>
