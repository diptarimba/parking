@extends('layout.master')

@section('title', 'Admin Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="Amin" subTitle="Admin Management">
        <x-slot name="header">
            {{ request()->routeIs('admin.create') ? 'Create Admin' : 'Update Admin' }}
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('admin.create') ? route('admin.store') : route('admin.update', @$admin->id) }}"
                class="theme-form mega-form" method="post" enctype="multipart/form-data">
                @csrf
                @isset($admin->avatar)
                    <x-forms.view-image label="Avatar" src="{{ asset($admin->avatar) }}" />
                @endisset
                <x-forms.file label="Pilih Photo Profil" name="avatar" id="gallery-photo-add" />
                <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
                <x-forms.put-method />
                <x-forms.input label="Name" name="name" :value="@$admin->name" />
                <x-forms.input label="Username" name="username" :value="@$admin->username" />
                <x-forms.input label="Email" name="email" type="email" :value="@$admin->email" />
                <x-forms.text label="Phone" name="phone" :value="@$admin->phone" />
                <x-forms.text password label="Password" name="password" :value="@$admin->usernam" />
            </form>
            <button form="form" class="btn btn-primary btn-pill">Submit</button>
            <x-action.cancel />
        </x-slot>
    </x-card.layout>
@endsection

@section('footer-content')

@endsection
