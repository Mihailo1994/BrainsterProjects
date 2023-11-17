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
    <div class="p-3 mb-3 border rounded border-primary">
        <form action="{{route('location.update', $location->id)}}" method="POST">
            @csrf
            <div class="row">
                <p class="mb-3">Измени локација</p>
                <div class="col">
                    <label class="mb-2">Држава</label>
                    <select name="country_id" class="form-control mb-3">
                        @foreach ($countries as $country)
                            @if ($country->id == $location->country_id)
                                <option value="{{$country->id}}" selected>{{$country->name}}</option>
                            @else
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Зачувај</button>
                    <a href="{{route('location.index')}}" class="btn btn-primary">Откажи</a>
                </div>
                <div class="col">
                    <label class="mb-2">Регион</label>
                    <input type="text" name="region" class="form-control" value="{{$location->region}}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


