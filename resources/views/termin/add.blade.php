@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row" id="section">
            <div class="col">
                <div class="mb-3 p-3 border rounded">
                    <p>Термини за: {{$accommodation->name}}, {{$accommodation->location->country->name}} {{$accommodation->location->region}}</p>
                </div>
                <div id="generate-section">
                    <form method="GET" action="{{route('termin.generate', $accommodation->id)}}">
                        @csrf
                        <div class="mb-3 p-3 border rounded">
                            <div id="termin-section">
                                <div class="row termins mb-3" id="row-1">
                                    <div class="col">
                                        <label>Термин од</label>
                                        <input type="date" class="form-control" name="termins_from">
                                    </div>
                                    <div class="col">
                                        <label>Број на термини</label>
                                        <input type="number" class="form-control" name="termins_number">
                                    </div>
                                    <div class="col">
                                        <label>Број на ноќевања од термин</label>
                                        <input type="number" name="number_of_nights" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="generate-btn">Генерирај</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


