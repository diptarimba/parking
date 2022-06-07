@extends('layout.master')

@section('title', 'Parking Location Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('location.create')}}" title="Parking Location Management"/>
    </x-slot>

    <x-slot name="body">
        <table class="table table-striped datatables-target-exec">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                {{-- @foreach ($parkingLocations as $each)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$each->name}}</td>
                        <td>
                            <x-action.edit action="{{route('location.edit', $each->id)}}" />
                            <x-action.delete :ident="$each->id" action="{{route('location.destroy', $each->id)}}" />
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
        ajax: "{{ route('location.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
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
