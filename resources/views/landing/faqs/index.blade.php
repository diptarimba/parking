@extends('layout.master')

@section('title', 'Faq Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <x-card.h-buat url="{{route('faq.create')}}" title="Faq Management"/>
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
                            <x-action.edit action="{{route('faq.edit', $each->id)}}" />
                            <x-action.delete :ident="$each->id" action="{{route('faq.destroy', $each->id)}}" />
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
