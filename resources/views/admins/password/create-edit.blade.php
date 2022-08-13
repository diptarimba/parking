@extends('layout.master')

@section('title', 'Password')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout mainTitle="Profile" subTitle="Update Password">
    <x-slot name="header">
        Update Password
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ route('admin.password.update') }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.text password label="Current Password" name="current_password" value=""/>
            <x-forms.text password label="New Password" name="new_password" value=""/>
            <x-forms.text password label="New Password Confirmation" name="new_password_confirm" value=""/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
