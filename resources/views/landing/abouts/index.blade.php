@extends('layout.master')

@section('title', 'About Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('about.create')}}" title="About Management"/>
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
                        <td>
                            <x-action.edit action="{{route('about.edit', $each->id)}}" />
                            <x-action.delete :ident="$each->id" action="{{route('about.destroy', $each->id)}}" />
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
