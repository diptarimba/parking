@extends('layout.master')

@section('title', 'Parking Slot')

@section('header-content')

@endsection

@section('page-content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Parking Location</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Parking Slot</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @include('components.flash')
            <!--end breadcrumb-->
            @if (empty($response->slot) || empty($response->parking_location))
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Parking slot data not found!</h5>
                        </div>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Parking Slot Tersedia Motor
                        </div>
                        <div class="card-body">
                            {{$response->slot->parking_slot[0]->slot - $response->parking_location[0][1]}} / {{$response->slot->parking_slot[0]->slot}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Parking Slot Tersedia Mobil
                        </div>
                        <div class="card-body">
                            {{$response->slot->parking_slot[1]->slot - $response->parking_location[1][1]}} / {{$response->slot->parking_slot[1]->slot}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Parking Slot Digunakan Motor
                        </div>
                        <div class="card-body">
                            {{$response->parking_location[0][1]}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            Parking Slot Digunakan Mobil
                        </div>
                        <div class="card-body">
                            {{$response->parking_location[1][1]}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('footer-content')
@endsection
