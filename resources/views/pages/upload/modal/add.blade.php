<div class="modal fade" id="modal_add_upload" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack align-items-center">
                <div class="fs-2 fw-bold">Upload Slip</div>

                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <form class="modal-body pt-10 pb-15 px-lg-17" id="form_add_upload">
                <div class="px-3" style="max-height: 400px; overflow-y: auto;">
                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">File</span>
                        </label>
                        <input type="file" class="form-control form-control-lg form-control-solid" name="file" required
                            placeholder="" value="">
                    </div>
                </div>

                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-light me-3 w-lg-200px"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-info w-lg-200px">
                        <span class="indicator-label">Kirim</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#form_add_upload').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            // $('#form_add_upload [type="submit"]').attr('disabled', true);
            // $('#form_add_upload [type="submit"]').html(
            //     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            // );
            $.ajax({
                url: "{{ route('upload.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    $('#form_add_upload [type="submit"]').attr('disabled', false);
                    $('#form_add_upload [type="submit"]').html('Kirim')
                    $('#modal_add_upload').modal('hide');

                    $('#form_add_upload').trigger('reset');
                    uploadTable?.draw();
                },
                error: function(xhr, status, error) {
                    // const data = xhr.responseJSON;
                    // toastr.error(data.message, 'Opps!');
                    // $('#form_add_upload [type="submit"]').attr('disabled', false);
                    // $('#form_add_upload [type="submit"]').html('Kirim')
                }
            });
        });
    });
</script>
