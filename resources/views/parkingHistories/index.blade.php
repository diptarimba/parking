@extends('layout.master')

@section('title', 'Parking History Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="History" subTitle="Parking History Management">
        <x-slot name="header">
            <x-card.h-buat url="{{ route('histories.export') }}" customButton="Export" title="Parking History Management" />
        </x-slot>

        <x-slot name="body">
            <table class="table datatables-target-exec table-striped">
                <thead>
                    <th>No</th>
                    <th>Kendaraan</th>
                    <th>Lokasi</th>
                    <th>Amount</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Payment Type</th>
                    {{-- <th>Action</th> --}}
                </thead>
            </table>
        </x-slot>
    </x-card.layout>
@endsection

@section('footer-content')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            var table = $('.datatables-target-exec').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('histories.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sortable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'vehicle',
                        name: 'vehicle'
                    },
                    {
                        data: 'parking_location.name',
                        name: 'parking_location.name'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'check_in',
                        name: 'check_in'
                    },
                    {
                        data: 'check_out',
                        name: 'check_out'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ]
            });
        })
    </script>
@endsection
