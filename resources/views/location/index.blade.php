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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="p-3 mb-3 border rounded border-primary">
        <div class="row">
            <div class="col">
                <p>Додади држава</p>
                <form action="{{route('location.country.store')}}" method="POST">
                    @csrf
                    <input type="text" name="name" value='{{old('name')}}' class="form-control mb-2">
                    <button class="btn btn-primary btn-sm" type="submit">Додади</button>
                </form>
            </div>
            <div class="col">
                <p>Избриши држава</p>
                <form action="{{route('location.country.delete')}}" method="POST">
                    @csrf
                    <select name="id" class="form-control mb-2">
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-danger" type="submit">Избриши</button>
                </form>
            </div>
            <div class="col">
                <p>Измени држава</p>
                <div id="select-update">
                    <select class="form-control mb-2" id="select-update-country">
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-warning" type="submit" id="update-country-btn">Измени</button>
                </div>
                <form action="{{route('location.country.update')}}" method="POST" id="update-country" class="d-none">
                    @csrf
                    <input type="text" hidden name="id" id="country-id">
                    <input type="text" name="name" class="form-control mb-2" id="country-name-input">
                    <button class="btn btn-warning btn-sm mx-2" type="submit">Зачувај</button>
                    <button class="btn btn-warning btn-sm" id="cancel-country-btn">Откажи</button>
                </form>
            </div>
        </div>
    </div>
    <div class="p-3 mb-3 border rounded border-primary">
        <div class="row">
            <div class="col">
                <p>Додади дестинација</p>
                <form action="{{route('location.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label class="mb-2">Држава</label>
                            <select name="country_id" class="form-control mb-2">
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="mb-2">Регион</label>
                            <input type="text" name="region" value='{{old('region')}}' class="form-control mb-2">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">Додади</button>
                </form>
            </div>
        </div>
    </div>

    @if ($locations->isEmpty())
        <p>Немате дестинаци. Додадете нови дестинации</p>
    @else
       <div class="row">
            <div>
                <p>Дестинации</p>
                <table>
                    <thead>
                        <tr class="border-bottom">
                            <th style="min-width: 150px" class="p-3">Држава</th>
                            <th style="min-width: 150px">Регион</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td colspan="2" class="p-1"><input placeholder="Пребарувај..." class="form-control" id="search-input">
                            </td>
                        </tr>
                         @foreach ($locations as $location)
                            <tr class="border-bottom">
                                <td class="p-3 country">{{$location->name}}</td>
                                <td class="region">{{$location->region}}</td>
                                <td>
                                    <form action="{{route('location.delete')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="text" value="{{$location->id}}" hidden name="id">
                                        <button type="submit" class="btn btn-danger btn-sm">Избриши</button>
                                    </form>
                                    <a href="{{url('location/edit/'.$location->id)}}" class="btn btn-sm btn-warning mx-2">Едитирај</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>
       <div id="edit-section"></div>
    @endif
</div>

<script src="/js/location.js"></script>
@endsection


