@extends('layout.master')

@section('title', 'Optional Content Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('optional.content.create') ? 'Create Optional Content' : 'Update Optional Content' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('optional.content.create') ? route('optional.content.store'): route('optional.content.update', @$optionalContent->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method  />
            <x-forms.input label="Title" name="title" :value="@$optionalContent->title"/>
            <x-forms.input label="Description" name="description" :value="@$optionalContent->description"/>
            <x-forms.text label="Target Tag" name="target" :value="@$optionalContent->target"/>
            <x-forms.text label="Navbar Menu Name" name="menu" :value="@$optionalContent->menu"/>
            <x-forms.text label="Default Menu Name" name="deafult" :value="@$optionalContent->default"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
