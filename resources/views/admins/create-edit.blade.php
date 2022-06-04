@extends('layout.master')

@section('title', 'Admin Management')

@section('header-content')

@endsection

@section('page-content')
<x-card.layout >
    <x-slot name="header">
        {{ request()->routeIs('admin.create') ? 'Create Admin' : 'Update Admin' }}
    </x-slot>
    <x-slot name="body">
        <form id="form"
            action="{{ request()->routeIs('admin.create') ? route('admin.store'): route('admin.update', @$admin->id) }}"
            class="theme-form mega-form" method="post"
            enctype="multipart/form-data">
            @csrf
            @isset($admin->avatar)
                <x-forms.view-image label="Avatar" src="{{asset('storage/' . $admin->avatar)}}" />
            @endisset
            <x-forms.file label="Pilih Photo Profil" name="avatar" id="gallery-photo-add"/>
            <div class="gallery row row-cols-4 justify-content-center" id="isi-gallery"></div>
            <x-forms.put-method  />
            <x-forms.input label="Name" name="name" :value="@$admin->name"/>
            <x-forms.input label="Username" name="username" :value="@$admin->username"/>
            <x-forms.input label="Email" name="email" type="email" :value="@$admin->email"/>
            <x-forms.text label="Phone" name="phone" :value="@$admin->phone"/>
            <x-forms.text password label="Password" name="password" :value="@$admin->usernam"/>
        </form>
        <button form="form" class="btn btn-primary btn-pill">Submit</button>
        <x-action.cancel />
    </x-slot>
</x-card.layout>
@endsection

@section('footer-content')
<script>
    $(document).ready(() => {
        //function untuk menampilkan preview image
        var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var card = $('<div/>').attr({
                        class: 'col mx-1 card'
                    })

                    var divImage = $('<div/>').attr({
                        class: 'my-auto'
                    })

                    $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'img-thumbnail imagePreview').appendTo(divImage);

                    divImage.appendTo(card);

                    var divFooter = $('<div/>').attr({
                        class: 'card-footer'
                    })

                    // buttonImage.appendTo(divFooter);
                    divFooter.appendTo(card);
                    card.appendTo(placeToInsertImagePreview);

                    if($('.imagePreview').length > 10){
                        alert('Upload Gambar dibatasi hingga 10 gambar')
                        return;
                    }
                }

                reader.readAsDataURL(input.files[i]);
            }
            }
        };
        //Menampilkan Thumbnail sebelum upload
        $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
        });

        //Menghapus Thumbnail apabila terdapat pergantian file upload
        $('#gallery-photo-add').on('click', function(){
        // console.log('Masuk')
        let parent = document.getElementById("isi-gallery")
        while (parent.firstChild) {
            parent.firstChild.remove()
        }
        });
    })
</script>

@endsection
