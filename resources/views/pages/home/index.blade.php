@extends('layouts.admin.main')
@section('title', 'Dashboard')

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            <h2>
                List Slip Gaji
            </h2>
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

    $(document).ready(function() {
        slipTable; = $('#table_slip').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            deferRender: true,
            responsive: false,
            ajax: {
                url: "{{ route('slip.table') }}",
                // data: function(data) {
                //     data.city = $('#filter_city').val();
                // }
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
