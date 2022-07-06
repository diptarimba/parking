@extends('layout.master')

@section('title', 'Profile')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout mainTitle="Profile" subTitle="Update Profile">
    <x-slot name="header">
        Update Profile
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ route('user.profile.update') }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            @isset($user->avatar)
                <x-forms.view-image label="Avatar" src="{{asset( $user->avatar)}}" />
            @endisset
            <x-forms.file label="Pilih Photo Profil" name="avatar" id="gallery-photo-add"/>
            <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
            <x-forms.input label="Name" name="name" :value="@$user->name"/>
            <x-forms.input label="Email" name="email" :value="@$user->email"/>
            <x-forms.input label="Username" name="username" :value="@$user->username"/>
            <x-forms.input label="Phone" name="phone" :value="@$user->phone"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
