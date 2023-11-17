@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5 container-fluid">
    <div class="row mb-4">
        <div class="col">
            <a href="{{route('accommodation.index')}}" class="text-decoration-none">
                <div class="card card-1" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-house fas"></i></h5>
                        <p class="card-text h6">Сместувања</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('location.index')}}" class="text-decoration-none">
                <div class="card card-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-location-dot fas"></i></h5>
                        <p class="card-text h6">Дестинации</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('testimonial.index')}}" class="text-decoration-none">
                <div class="card card-3" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-regular fa-newspaper fas"></i></h5>
                        <p class="card-text h6 ">Тестимониал</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{route('subscribers.show')}}" class="text-decoration-none">
                <div class="card card-4" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-user fas"></i></h5>
                        <p class="card-text h6">Претплатници</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('tickets.index')}}" class="text-decoration-none">
                <div class="card card-5" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-plane fas"></i></h5>
                        <p class="card-text h6">Билети</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('offers.index')}}" class="text-decoration-none">
                <div class="card card-6" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-percent fas"></i></h5>
                        <p class="card-text h6">Понуди</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
        @if(Auth::user()->type === 'admin')
        <div class="row">
            <div class="col-4">
                <a href="{{route('users')}}" class="text-decoration-none">
                    <div class="card card-7" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-regular fa-address-card fas"></i></h5>
                            <p class="card-text h6">Корисници</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>





@endsection


