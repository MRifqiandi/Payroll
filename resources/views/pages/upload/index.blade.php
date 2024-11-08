@extends('layouts.admin.main')
@section('title', 'Upload')

@section('modal')
    @include('pages.upload.modal.add')
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
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0" id="table_invoice">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="w-50px text-center">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA</th>
                            <th>PENERIMA</th>
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

@endsection
