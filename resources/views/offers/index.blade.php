@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5 container-fluid">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <a href="{{route('offers.add')}}"><button class="btn btn-primary mb-3">Додади актуелна понуда</button></a>

    @if($offer === null)
        <p>Немате актуелна понуда</p>
    @else
    <div class="border rounded p-4 mb-3">
            <p>Акутелна понуда</p>
            <div class="row">
                <div class="col">
                    <p>Држава</p>
                    <p>{{$locations[0]->country->name}}</p>
                </div>
                @foreach($locations as $location)
                <div class="col">
                    <p>Локација</p>
                    <p>{{$location->region}}</p>
                </div>
                @endforeach
            </div>
        </div>
    @endif
</div>




@endsection


