@extends('layout.master')

@section('title', 'Feedback Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('feedback.create') ? 'Create Feedback' : 'Update Feedback' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('feedback.create') ? route('feedback.store'): route('feedback.update', @$feedback->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            @isset($feedback->avatar)
                <x-forms.view-image label="Avatar" src="{{asset( $feedback->avatar)}}" />
            @endisset
            <x-forms.file label="Pilih Photo Profil" name="avatar" id="gallery-photo-add"/>
            <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
            <x-forms.put-method  />
            <x-forms.input label="Name" name="name" :value="@$feedback->name"/>
            <x-forms.text label="Feedback" name="feedback" :value="@$feedback->feedback"/>
            <x-forms.input type="number" label="Star Count" name="star_count" :value="@$feedback->star_count"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
