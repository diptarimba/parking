@extends('layout.master')

@section('title', 'Feedback Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="Feedback" subTitle="FeedBack Management">
        <x-slot name="header">
            <x-card.h-buat url="{{ route('feedback.create') }}" title="Feedback Management" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-striped datatables-target-exec">
                <thead>
                    <th>No</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Feedback</th>
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
                ajax: "{{ route('feedback.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'avatar',
                        name: 'avatar'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'feedback',
                        name: 'feedback'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    "targets": 1,
                    "data": 'avatar',
                    "render": function(data, type, row, meta) {
                        return '<img src="{{ url('/') . '/' }}' + data + '" alt="' + data +
                            '" class="img-thumbnail" style="max-width: 200px;"/>';
                    }
                }],
            });
        })
    </script>
@endsection
