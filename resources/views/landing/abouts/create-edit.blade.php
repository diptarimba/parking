@extends('layout.master')

@section('title', 'About Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="About" subTitle="About Management">
        <x-slot name="header">
            {{ request()->routeIs('about.create') ? 'Create About' : 'Update About' }}
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('about.create') ? route('about.store') : route('about.update', @$about->id) }}"
                class="theme-form mega-form" method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <div class="mb-2">
                    <div class="col-form-label">Icon</div>
                    <select class="form-control" data-placeholder="Pilih Icon" name="icon_id">
                        <option {{ @$about->icon_id == null ? 'selected' : '' }}>Select Icon</option>
                        @foreach ($icon as $each)
                            <option value="{{ $each->id }}" @if (@$about->icon_id == $each->id) selected @endif>
                                {{ $each->title }}</option>
                        @endforeach
                    </select>
                </div>
                <x-forms.input label="Text" name="title" :value="@$about->title" />
                <x-forms.input label="Description" name="description" :value="@$about->description" />
            </form>
            <button form="form" class="btn btn-primary btn-pill">Submit</button>
            <x-action.cancel />
        </x-slot>
    </x-card.layout>
@endsection

@section('footer-content')
@endsection
