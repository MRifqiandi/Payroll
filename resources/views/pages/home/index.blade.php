@extends('layouts.admin.main')
@section('title', 'Dashboard')

@section('modal')
    @if (auth()->user()['2fa_secret'])
        @include('layouts.admin.validate_2fa_modal')
    @endif
@endsection

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <h2>
                List Slip Gaji
            </h2>
            <div>Golongan : {{ auth()->user()->rank }}</div>
            <p>Base Salary : <span class="text-success">{{ \App\Utils::GET_SALARY_AMOUNT(auth()->user()->rank, auth()->user()->join_date) }}/month</span> </p>
            <div class="table-responsive" style="overflow: hidden">
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0" id="table_slip">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="w-50px text-center">NO</th>
                            <th>NAMA</th>
                            <th>TANGGAL</th>
                            <th>OLEH</th>
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
        let slipTable;

        function onDonwload() {
            @if (auth()->user()['2fa_secret'] && !\App\Utils::IS_DEVICE_VALIDATED())
                $('#modal_validate_2fa').modal('show');
            @else
                const $button = $(this);
                const id = $button.data('id');
                const url = `{{ route('slip.download', '') }}/${id}`;


                $button.addClass('loading');

                const anchor = document.createElement('a');
                anchor.href = url;
                anchor.download = true;

                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);


                setTimeout(() => {
                    $button.removeClass('loading').addClass('done');
                    setTimeout(() => {
                        $button.removeClass('done');
                    }, 2000);
                }, 5000);
            @endif
        };

        $(document).ready(function() {
            $(document).on('click', '.slip-download-button', onDonwload);

            slipTable = $('#table_slip').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                deferRender: true,
                responsive: false,
                ajax: {
                    url: "{{ route('slip.table') }}",
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
        });
    </script>
@endsection
