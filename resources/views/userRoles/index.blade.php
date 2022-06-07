@extends('layout.master')

@section('title', 'User Role Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('roles.create')}}" title="User Role Management"/>
    </x-slot>

    <x-slot name="body">
        <table class="table table-striped">
            <thead>
                <th>No</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($userRoles as $each)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$each->name}}</td>
                        <td>
                            <x-action.edit action="{{route('roles.edit', $each->id)}}" />
                            <x-action.delete :ident="$each->id" action="{{route('roles.destroy', $each->id)}}" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')

@endsection