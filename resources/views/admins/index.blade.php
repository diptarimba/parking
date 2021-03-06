@extends('layout.master')

@section('title', 'Admin Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('admin.create')}}" title="Admin Management"/>
    </x-slot>

    <x-slot name="body">
        <table class="table table-striped datatables-target-exec">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                {{-- @foreach ($admin as $each)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <th><img src="{{ $each->avatar ? asset( $each->avatar ) : asset('storage/placeholder/avatar/default-profile.png') }}" class="img-rounded shadow" style="max-width: 100px" alt=""></th>
                        <td>{{$each->name}}</td>
                        <td>{{$each->email}}</td>
                        <td>
                            <x-action.edit action="{{route('admin.edit', $each->id)}}" />
                            <x-action.delete :ident="$each->id" action="{{route('admin.destroy', $each->id)}}" />
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
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
        ajax: "{{ route('admin.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',
                sortable: false,
                orderable: false,
                searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
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
