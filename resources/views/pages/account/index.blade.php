@extends('layouts.admin.main')
@section('title', 'Account')

@section('modal')
    @include('pages.account.modal.add')
    @include('pages.account.modal.edit')
    @include('pages.account.modal.reset-password')
@endsection

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            <div class="d-flex justify-content-between">
                <h2>
                    List Account
                </h2>
                <div>
                    <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal"
                        data-bs-target="#modal_add_account">
                        Add Account
                    </a>
                </div>
            </div>
            <div class="table-responsive" style="overflow: hidden">
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0" id="table_account">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="w-50px text-center">NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>NIP/NIPPPK/NIPH</th>
                            <th>PANGKAT/GOLONGAN</th>
                            <th>JABATAN</th>
                            <th>ROLE</th>
                            <th class="text-center">AKSI</th>
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
        let accountTable;

        const onAccountEdit = (id, name, email, number, rank, position, role) => {
            $('#modal_edit_account').modal('show');
            $('#modal_edit_account [name="id"]').val(id);
            $('#modal_edit_account [name="name"]').val(name);
            $('#modal_edit_account [name="email"]').val(email);
            $('#modal_edit_account [name="number"]').val(number);
            $('#modal_edit_account [name="rank"]').val(rank);
            $('#modal_edit_account [name="position"]').val(position);
            $('#modal_edit_account [name="role"]').val(role).trigger('change');
        };

        const onAccountResetpassword = (id, name, email) => {
            $('#modal_reset_password').modal('show');
            $('#modal_reset_password [name="id"]').val(id);
            $('#modal_reset_password #name').html(name);
            $('#modal_reset_password #email').html(email);
            $('#modal_reset_password [name="password"]').val();
        };

        const onDeleteAccount = (id) => {
            Swal.fire({
                title: 'Delete!',
                text: `Apakah Anda yakin ingin menghapus user ini?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 107, 85)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Yes, Delete!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('account.delete') }}",
                        type: 'POST',
                        data: {
                            id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Success',
                                text: `${data.message}`,
                                icon: 'success',
                                confirmButtonColor: 'green',
                            });

                            accountTable?.draw();
                        },
                        error: function(xhr, status, error) {
                            const data = xhr.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    });
                }
            });
        };

        const onDisableAuthenticator = (id) => {
            Swal.fire({
                title: 'Disable Authenticator!',
                text: `Apakah Anda yakin ingin menonaktifkan 2fa user ini?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 107, 85)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Yes, Disable!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('account.disable.authenticator') }}",
                        type: 'POST',
                        data: {
                            id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Success',
                                text: `${data.message}`,
                                icon: 'success',
                                confirmButtonColor: 'green',
                            });

                            accountTable?.draw();
                        },
                        error: function(xhr, status, error) {
                            const data = xhr.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    });
                }
            });
        };

        $(document).ready(function() {
            accountTable = $('#table_account').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                ajax: {
                    url: "{{ route('account.table') }}",
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
                        data: 'email',
                    },
                    {
                        data: 'number',
                    },
                    {
                        data: 'rank',
                    },
                    {
                        data: 'position',
                    },
                    {
                        data: 'role',
                    },
                    {
                        data: 'action'
                    }
                ],
                search: {
                    "regex": true
                },
                columnDefs: [{
                    targets: [0, 7],
                    className: 'text-center',
                }, ],
            });

            $(document).on('click', '.btn-edit-account', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const number = $(this).data('number');
                const rank = $(this).data('rank');
                const position = $(this).data('position');
                const role = $(this).data('role');

                onAccountEdit(id, name, email, number, rank, position, role);
            });

            $(document).on('click', '.btn-reset-password', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');

                onAccountResetpassword(id, name, email);
            });
        });
    </script>
@endsection
