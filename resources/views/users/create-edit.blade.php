@extends('layout.master')

@section('title', 'User Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('user.create') ? 'Create User' : 'Update User' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('user.create') ? route('user.store'): route('user.update', @$user->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            @isset($user->avatar)
                <x-forms.view-image label="Avatar" src="{{asset( $user->avatar)}}" />
            @endisset
            <x-forms.file label="Pilih Photo Profil" name="avatar" id="gallery-photo-add"/>
            <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
            <x-forms.put-method  />
            <x-forms.input label="Name" name="name" :value="@$user->name"/>
            <x-forms.input label="Username" name="username" :value="@$user->username"/>
            <x-forms.input type="email" label="Email" name="email" :value="@$user->email"/>
            <x-forms.text label="Phone" name="phone" :value="@$user->phone" />
            <x-forms.text password label="Passowrd" name="username" :value="@$user->usernam"/>
            <x-forms.select label="Select Role" :items="$userRole" name="user_role_id" :value="@$user->user_role_id"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
