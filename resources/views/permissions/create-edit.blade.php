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
            @foreach ($nameController as $key => $each)
            <div class="mb-3">
                <label for="{{$key}}Input" class="form-label">Name Controller</label>
                <input type="text" class="form-control" id="{{$key}}Input" name="role[{{$key}}][name]" value="{{$key}}">
            </div>
            @if (str_contains($each[0]['name'], 'index'))
            <div class="form-check">
                <input class="form-check-input" name="role[{{$key}}][value][index]" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
            @endif
            @if (str_contains($each[1]['name'], 'create') && str_contains($each[2]['name'], 'store'))
            <div class="form-check">
                <input class="form-check-input" name="role[{{$key}}][value][create]" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
            @endif
            @if (str_contains($each[4]['name'], 'edit') && str_contains($each[5]['name'], 'update'))
            <div class="form-check">
                <input class="form-check-input" name="role[{{$key}}][value][update]" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
            @endif
            @if (str_contains($each[6]['name'], 'destroy'))
            <div class="form-check">
                <input class="form-check-input" name="role[{{$key}}][value][delete]" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
            @endif
            @endforeach
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
