@extends('layout.master')

@section('title', 'Feature Management')

@section('header-content')

@endsection

@section('page-content')
<<<<<<< HEAD
    <x-card.layout mainTitle="Feature" subTitle="Feature Management">
        <x-slot name="header">
            {{ request()->routeIs('feature.create') ? 'Create Feature' : 'Update Feature' }}
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('feature.create') ? route('feature.store') : route('feature.update', @$feature->id) }}"
                class="theme-form mega-form" method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                @isset($feature->image)
                    <x-forms.view-image label="Image" src="{{ asset($feature->image) }}" />
                @endisset
                <x-forms.file label="Pilih Photo Profil" name="image" id="gallery-photo-add" />
                <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
                <span>Rekomendasi Ukuran Foto : {{ @$feature->recommendation }} px</span>
                <x-forms.input label="Title" name="title" :value="@$feature->title" />
                <x-forms.wysiwyg label="Description" name="description" :value="@$feature->description" />
                {{-- <x-forms.input label="Description" name="description" :value="@$feature->description"/> --}}
            </form>
            <button form="form" class="btn btn-primary btn-pill">Submit</button>
            <x-action.cancel />
        </x-slot>
    </x-card.layout>
=======
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('feature.create') ? 'Create Feature' : 'Update Feature' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('feature.create') ? route('feature.store'): route('feature.update', @$feature->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method />
            @isset($feature->image)
                <x-forms.view-image label="Image" src="{{asset( $feature->image)}}" />
            @endisset
            <x-forms.file label="Pilih Photo Profil" name="image" id="gallery-photo-add"/>
            <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
            {{-- <span>Rekomendasi Ukuran Foto : {{ @$feature->recommendation }} px</span> --}}
            <x-forms.input disabled label="Rekomendasi Ukuran Foto : " name="recommendation" :value="@$feature->recommendation"/>
            <x-forms.input label="Title" name="title" :value="@$feature->title"/>
            <x-forms.wysiwyg label="Description" name="description" :value="@$feature->description"/>
            {{-- <x-forms.input label="Description" name="description" :value="@$feature->description"/> --}}
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
>>>>>>> 52bebbfa5ef5112f0aad5bd3b9aaaef9d6dad3a0
@endsection

@section('footer-content')
<script>
    $('input[name="recommendation"]').prop('disabled', true);
</script>
@endsection
