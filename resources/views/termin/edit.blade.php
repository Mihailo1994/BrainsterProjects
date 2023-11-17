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
        <div class="row" id="generate-section">
            <div class="col">
                <div class="mb-3 p-3 border rounded">
                    <p>Измени термин за: {{$accommodation->name}}, {{$accommodation->location->country->name}} {{$accommodation->location->region}}</p>
                </div>
                <form method="POST" action="{{route('termin.update',$termin->id)}}">
                    @csrf
                    <div class="mb-3 p-3 border rounded">
                        <div id="termin-section">
                            <div class="row mb-3">
                                <div class="col">
                                    <label>Термин од</label>
                                    <input type="date" class="form-control" name="date_from" value="{{$termin->date_from}}">
                                </div>
                                <div class="col">
                                    <label>Термин до</label>
                                    <input type="date" class="form-control" name="date_until" value="{{$termin->date_until}}">
                                </div>
                                <div class="col">
                                    <label>Цена по ноќевање</label>
                                    <input type="number" name="price_per_night" class="form-control" value="{{$termin->price_per_night}}">
                                </div>
                                <div class="col">
                                    <label>Забелешка (опционално)</label>
                                    <input type="text" name="note" class="form-control" value="{{$termin->note}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="generate-btn">Зачувај</button>
                </form>
                <button onclick="history.back()" class="btn btn-primary">Откажи</button>
            </div>
        </div>
    </div>
</div>

@endsection


