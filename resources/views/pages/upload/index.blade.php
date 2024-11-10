@extends('layouts.admin.main')
@section('title', 'Upload')

@section('modal')
    @include('pages.upload.modal.add')
    @include('pages.upload.modal.receiver')
@endsection

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            <div class="d-flex justify-content-between">
                <h1>
                    History Upload
                </h1>
                <div>
                    <a href="#" class="btn btn-flex btn-success h-40px fs-7 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#modal_add_upload">
                        Upload
                    </a>
                </div>
            </div>
            <div class="table-responsive" style="overflow: hidden">
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0" id="table_upload">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="w-50px text-center">NO</th>
                            <th>NAMA</th>
                            <th>TANGGAL</th>
                            <th>OLEH</th>
                            <th>PENERIMA</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>

                    <tbody class="fs-7">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let uploadTable;

        $(document).ready(function() {
            uploadTable = $('#table_upload').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                ajax: {
                    url: "{{ route('upload.table') }}",
                },
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Tidak ada data terbaru 📁",
                    "zeroRecords": "Data tidak ditemukan 😞",
                },
                buttons: [],
                dom: "<'row mb-2'" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-start'l B>" +
                    "<'col-12 col-lg-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-12 col-lg-5 d-flex align-items-center justify-content-center justify-content-lg-start'i>" +
                    "<'col-12 col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-end'p>" +
                    ">",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'user',
                    },
                    {
                        data: 'receivers',
                    },
                    {
                        data: 'action'
                    }
                ],
                search: {
                    "regex": true
                },
                columnDefs: [{
                    targets: [0, 4],
                    className: 'text-center',
                }, ],
            });

            $(document).on('click', '.btn-view-receivers', function() {
                let id = $(this).data('id');

                $('#modal_view_receivers').modal('show');

                $.ajax({
                    url: "{{ route('upload.receivers') }}",
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        let data = response.data;

                        let html = '';

                        data.forEach((item, index) => {
                            html += `
                                <tr>
                                    <td class="text-center">${index + 1}</td>
                                    <td>${item.name}</td>
                                    <td>${item.email}</td>
                                </tr>
                            `;
                        });

                        $('#table_receivers tbody').html(html);
                    }
                });
            });

            $(document).on('click', '.btn-delete-upload', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('upload.delete') }}",
                            type: 'POST',
                            data: {
                                id: id
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                toastr.success(response.message, 'Selamat 🚀 !');
                                uploadTable.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                const data = xhr.responseJSON;
                                toastr.error(data.message, 'Opps!');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
