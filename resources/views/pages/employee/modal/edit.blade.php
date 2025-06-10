<!-- Modal Edit Pegawai -->
<div class="modal fade" id="modal_edit_employee" tabindex="-1" aria-labelledby="modalEditEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('employee.update') }}" id="formEditEmployee">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">✏️ Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body row g-3">
                    <input type="hidden" name="id" id="edit_id">

                    @php
                        $statusList = ['aktif', 'tugas belajar', 'tidak aktif'];
                        $statusNikah = ['lajang', 'menikah', 'cerai'];
                    @endphp

                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" id="edit_nik" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" id="edit_alamat" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggalLahir" id="edit_tanggalLahir" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggalMasuk" id="edit_tanggalMasuk" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tanggalKeluar" id="edit_tanggalKeluar" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status Pernikahan</label>
                        <select name="statusPernikahan" id="edit_statusPernikahan" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach($statusNikah as $item)
                                <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status Kepegawaian</label>
                        <select name="statusKepegawaian" id="edit_statusKepegawaian" class="form-select">
                            <option value="">-- Pilih --</option>
                            @foreach($statusList as $item)
                                <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="col-md-4">
                        <label class="form-label">Masa Kerja</label>
                        <input type="number" name="masaKerja" id="edit_masaKerja" class="form-control" min="0">
                    </div> -->

                    <div class="col-md-4">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="edit_jabatan" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Departemen</label>
                        <input type="text" name="departemen" id="edit_departemen" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Golongan</label>
                        <input type="text" name="golongan" id="edit_golongan" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NPWP</label>
                        <input type="text" name="npwp" id="edit_npwp" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">PTKP ID</label>
                        <input type="number" name="ptkp_id" id="edit_ptkp_id" class="form-control" min="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jabatan Fungsional ID</label>
                        <input type="number" name="jabatan_fungsional_id" id="edit_jabatan_fungsional_id" class="form-control" min="0">
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
