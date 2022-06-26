@extends('layout.master')

@section('title', 'User Role Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        Krarak
        {{-- {{ request()->routeIs('roles.create') ? 'Create User Role' : 'Update User Role' }} --}}
    </x-slot>
    <x-slot name="body">
        <form>
        {{-- <form id="form"
            action="{{ request()->routeIs('roles.create') ? route('roles.store'): route('roles.update', @$userRole->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data"> --}}
            @csrf
            <x-forms.put-method />
            @foreach ($allowController as $key => $each)
                <label class="form-label">{{$key}}</label>
                @foreach ($each as $keyEach => $valueEach)
                <div class="form-check">
                    <input class="form-check-input" name="role[{{$key}}][{{$valueEach}}]" type="checkbox" value="" id="{{$key.$valueEach}}">
                    <label class="form-check-label" for="{{$key.$valueEach}}">
                        {{$valueEach}}
                    </label>
                </div>
                @endforeach
            <hr>
            @endforeach
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
