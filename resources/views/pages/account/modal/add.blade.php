<div class="modal fade" id="modal_add_account" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header flex-stack align-items-center">
                <div class="fs-2 fw-bold">Add User</div>

                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <form class="modal-body pt-10 pb-15 px-lg-17" id="form_add_account">
                <div class="px-3" style="max-height: 400px; overflow-y: auto;">
                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Role</span>
                        </label>
                        <select name="role" class="form-select form-select-solid" data-control="select2" required
                            data-hide-search="true" data-placeholder="Role" data-select2-parent="#modal_add_account">
                            <option value="" disabled>Pilih Role</option>
                            <option value="staff">Staff</option>
                            <option value="finance">Finance</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Nama</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="name"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">NIP/NIPPPK/NIPH</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="number"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Pangkat/Golongan</span>
                        </label>
                        {{-- <input type="text" class="form-control form-control-lg form-control-solid" name="rank" required
                            placeholder="" value=""> --}}
                        <select name="rank" class="form-select form-select-solid" data-control="select2" required autocomplete="off"
                            data-select2-parent="#modal_add_account">
                            <option value="" disabled selected>Pilih Golongan</option>
                            @foreach (\App\Constants::USER_RANK as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Jabatan</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="position"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="email"
                            required placeholder="" value="">
                    </div>

                    <div class="fv-row mb-3">
                        <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                            <span class="required">Password</span>
                        </label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="password"
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
        $('#form_add_account').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $('#form_add_account [type="submit"]').attr('disabled', true);
            $('#form_add_account [type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
            $.ajax({
                url: "{{ route('account.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    toastr.success(data.message, 'Selamat 🚀 !');
                    $('#form_add_account [type="submit"]').attr('disabled', false);
                    $('#form_add_account [type="submit"]').html('Simpan')
                    $('#modal_add_account').modal('hide');

                    $('#form_add_account').trigger('reset');
                    accountTable?.draw();
                },
                error: function(xhr, status, error) {
                    const data = xhr.responseJSON;
                    toastr.error(data.message, 'Opps!');
                    $('#form_add_account [type="submit"]').attr('disabled', false);
                    $('#form_add_account [type="submit"]').html('Simpan')
                }
            });
        });
    });
</script>
