@extends('layout.master')

@section('title', 'Faq Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('faq.create') ? 'Create Faq' : 'Update Faq' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('faq.create') ? route('faq.store'): route('faq.update', @$faq->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            <x-forms.put-method />
            <x-forms.input label="Question" name="question" :value="@$faq->question"/>
            <x-forms.input label="Answer" name="answer" :value="@$faq->answer"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
@endsection
