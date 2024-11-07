@extends('layouts.admin.main')
@section('title', 'Dashboard')

@section('content')
    <div class="card card-flush h-md-100">
        <div class="card-body pt-6">
            <h2>
                SLIP GAJI
            </h2>
            <div class="table-responsive" style="overflow: hidden">
                <table class="table table-striped table-row-dashed align-middle gs-0 gy-3 my-0" id="table_invoice">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="w-50px text-center">NO</th>
                            <th>TYPE</th>
                            <th>INVOICE DATE</th>
                            <th>DUE DATE</th>
                            <th>NOMOR</th>
                            <th>CUSTOMER</th>
                            <th>SHIP TO</th>
                            <th>TOTAL PRICE</th>
                            <th>PAID AT</th>
                            <th>STATUS</th>
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
