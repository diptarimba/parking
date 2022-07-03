@extends('layout.master')

@section('title', 'User Role Management')

@section('header-content')
<link rel="stylesheet" href="{{ asset('assets/css/chosen.css') }}" />
@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <span class="h4 text-bold">Update User Location [ {{$user->name}} ] </span>
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ route('user.location.update', $user->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method />
            <div class="mb-2">
                <label class="form-label" for="datalistOptions">Lokasi</label>
                <select id="datalistOptions" class="form-select chosen-select" multiple name="location[]" aria-label="Default Product">
                    @foreach($parkingLocation as $key => $each)
                        <option value="{{$key}}">{{$each}}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
        <hr>
        <span class="h4 text-center">Daftar User Lokasi</span>
        <table class="table datatables-target-exec table-striped">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Location</th>
                <th>Action</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script>
    $(document).ready(() => {
        var table = $('.datatables-target-exec').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user.location.edit', $user->id) }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', sortable: false, orderable:false, searchable:false},
            {data: 'user.[0].name', name: 'user.[0].name'},
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
<script>
    $(document).ready(() => {
        $(function(){
            $(".chosen-select").chosen();
        })
    });
</script>

@endsection
