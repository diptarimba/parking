@extends('layout.master')

@section('title', 'Parking Location Management')

@section('header-content')
    <script src="https://cdn.tiny.cloud/1/usrh3hgyki8crrknq3mqog2q8v5nhx4kug3pa3d8dj8mr7m7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
                'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
@endsection

@section('page-content')
    <div class="col-md-8 mx-auto">
        <x-card.layout mainTitle="Location" subTitle="Parking Location Management">
            <x-slot name="header">
                {{ request()->routeIs('location.create') ? 'Create Parking Location' : 'Update Parking Location' }}
            </x-slot>
            <x-slot name="body">
                <form id="form"
                    action="{{ request()->routeIs('location.create') ? route('location.store') : route('location.update', @$parkingLocation->id) }}"
                    class="theme-form mega-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-forms.put-method />
                    <x-forms.input label="Name" name="name" :value="@$parkingLocation->name" />
                    <x-forms.wysiwyg label="Description" name="description" :value="@$parkingLocation->description" />
                    <x-forms.maps label="Location" latName="latitude" lngName="longitude" :lat="@$parkingLocation->latitude"
                        :lng="@$parkingLocation->longitude" />
                </form>
                <button form="form" class="btn btn-primary btn-pill">Submit</button>
                <x-action.cancel />
            </x-slot>
        </x-card.layout>
    </div>
@endsection

@section('footer-content')
@endsection
