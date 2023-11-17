@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5">
    <div class="mb-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{route('accommodation.add')}}" class="btn btn-primary">Додади сместување</a>
    </div>
    @if ($accommodations->isEmpty())
        <p>Немате сместувања. Додадете ново сместување</p>
    @else
        <div class="mb-2">
            <div class="row">
                <label class="mb-2">Филтер по држави</label>
                <div class="col-2">
                    <select id="filter" class="form-control">
                        <option value="all" selected>Сите</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->name}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @foreach ($accommodations as $accommodation)
        <a href="{{url('accommodation/show/'.$accommodation->id)}}" class="text-decoration-none text-black country {{$accommodation->location->country->name}}">
            <div class="p-4 border rounded mb-3 link">
                <div class="row">
                    <div class="col-auto">
                        <p>{{$accommodation->name}}</p>
                        <p>Локација: {{$accommodation->location->country->name}}, {{$accommodation->location->region}}</p>
                        <p>Рејтинг
                        @php
                            $n = $accommodation->rating;
                        @endphp
                        @for ($i = 1; $i <= $n; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                        </p>
                    </div>
                    <div class="col-auto">
                        @foreach ($accommodation->images as $image)
                            <img style="width: 100px" src="{{$image->image_path}}" alt="img">
                        @endforeach
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    @endif
</div>

<script src="/js/accommodation.js"></script>

@endsection


