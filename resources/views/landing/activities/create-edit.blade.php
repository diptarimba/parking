@extends('layout.master')

@section('title', 'Activity Management')

@section('header-content')

@endsection

@section('page-content')
    <x-card.layout mainTitle="Activity" subTitle="Activity Management">
        <x-slot name="header">
            {{ request()->routeIs('activity.create') ? 'Create Activity' : 'Update Activity' }}
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('activity.create') ? route('activity.store') : route('activity.update', @$activity->id) }}"
                class="theme-form mega-form" method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <div class="mb-2">
                    <div class="col-form-label">Icon</div>
                    <select class="form-control" data-placeholder="Pilih Icon" name="zmdi_id">
                        <option {{ @$about->zmdi_id == null ? 'selected' : '' }}>Select Icon</option>
                        @foreach ($zmdi as $each)
                            <option value="{{ $each->id }}" @if (@$activity->zmdi_id == $each->id) selected @endif>
                                {{ $each->title }}</option>
                        @endforeach
                    </select>
                </div>
                <x-forms.input label="Title" name="description" :value="@$activity->description" />
                <x-forms.input label="Estimate Values" name="title" :value="@$activity->title" />
            </form>
            <button form="form" class="btn btn-primary btn-pill">Submit</button>
            <x-action.cancel />
        </x-slot>
    </x-card.layout>
@endsection

@section('footer-content')
@endsection
