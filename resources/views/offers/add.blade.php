@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5 container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <div class="border rounded p-4 mb-3">
    <form action="{{route('offers.store')}}" method="POST" class="mb-0">
        @csrf
        <div class="row mb-4">
            <div class="col">
                <label class="mb-2">Држава</label>
                <select name="country" id="country" class="form-control">
                    <option selected disabled>Избери држава</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="mb-2">Регион 1</label>
                <select name="location_1" class="form-control location">

                </select>
            </div>
            <div class="col">
                <label class="mb-2">Регион 2</label>
                <select name="location_2" class="form-control location">

                </select>
            </div>
            <div class="col">
                <label class="mb-2">Регион 3</label>
                <select name="location_3" class="form-control location">

                </select>
            </div>
            <div class="col">
                <label class="mb-2">Регион 4</label>
                <select name="location_4" class="form-control location">

                </select>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Зачувај</button>
        </div>
    </form>
    </div>
</div>




<script src="/js/offer.js"></script>
@endsection


