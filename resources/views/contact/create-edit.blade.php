@extends('layout.master')

@section('title', 'Contact Message Detail')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout mainTitle="Contact" subTitle="View Contact">
    <x-slot name="header">
        View Contact
    </x-slot>
    <x-slot name="body">
        <form id="onlyView">
            <x-forms.input label="Name" name="name" :value="@$contact->name"/>
            <x-forms.input label="Email" name="email" :value="@$contact->email"/>
            <x-forms.textarea label="Content" name="content" :value="@$contact->content" />
        </form>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
<script>
    $('#onlyView input').prop('disabled', true);
    $('#onlyView textarea').prop('disabled', true);
</script>
@endsection
