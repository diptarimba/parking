@extends('layout.master')

@section('title', 'Feature Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="Feature" subTitle="Feature Management">
        <x-slot name="header">
            <h3 class="text-900 mb-0" data-anchor>Feature Management</h3>
            {{-- <x-card.h-buat url="{{ route('feature.create') }}" title="Feature Management" /> --}}
        </x-slot>

        <x-slot name="body">
            <table class="table table-striped datatables-target-exec">
                <thead>
                    <th>No</th>
                    <th>Title</th>
                    <th>Email</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
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
                ajax: "{{ route('feature.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sortable: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
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
