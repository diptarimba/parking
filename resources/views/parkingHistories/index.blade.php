@extends('layout.master')

@section('title', 'User Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('user.create')}}" title="User Management"/>
    </x-slot>

    <x-slot name="body">
        <table class="table datatables-target-exec table-striped">
            <thead>
                <th>No</th>
                <th>Lokasi</th>
                <th>Amount</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Action</th>
            </thead>
        </table>
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script>
    $(document).ready(() => {
        var table = $('.datatables-target-exec').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('histories.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'parking_location.name', name: 'parking_location.name'},
            {data: 'pay_amount', name: 'pay_amount'},
            {data: 'start_time', name: 'start_time'},
            {data: 'end_time', name: 'end_time'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    })
</script>
@endsection
