@extends('layout.master')

@section('title', 'User Role Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('roles.create') ? 'Create User Role' : 'Update User Role' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('roles.create') ? route('roles.store'): route('roles.update', @$userRole->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method />
            <x-forms.input label="Name" name="name" :value="@$userRole->name"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
