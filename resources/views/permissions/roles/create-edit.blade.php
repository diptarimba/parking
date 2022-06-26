@extends('layout.master')

@section('title', 'User Role Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        <span class="h4 text-bold">Update User Role [ {{$role->name}} ] </span>
        {{-- {{ request()->routeIs('roles.create') ? 'Create User Role' : 'Update User Role' }} --}}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ route('roles.permission.update', $role->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method />
            @foreach ($allowController as $key => $each)
                <label class="form-label">{{$key}}</label>
                @foreach ($each as $keyEach => $valueEach)
                <div class="form-check">
                    <input class="form-check-input" name="role[{{$key}}][{{$valueEach}}]" type="checkbox" id="{{$key.$valueEach}}">
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
