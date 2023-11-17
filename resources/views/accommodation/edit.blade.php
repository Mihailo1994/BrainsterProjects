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
    <form action="{{route('accommodation.update', $accommodation->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="mb-2">Име на сместувањето</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$accommodation->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="mb-2">Рејтинг</label>
                        <select name="rating" class="form-control" id="rating">
                            @for ($i = 1; $i <= 6; $i++)
                                @if ($i == $accommodation->rating)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="accommodation_type" class="mb-2">Тип на сместување</label>
                        <select name="accommodation_type" class="form-control" id="accommodation_type">
                            @foreach($accommodationTypes as $type)
                                @if ($accommodation->accommodation_type_id == $type->id)
                                    <option value="{{$type->id}}" selected>{{$type->type_of_accommodation}}</option>
                                @else
                                    <option value="{{$type->id}}">{{$type->type_of_accommodation}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="mb-2">Слики: (Може да остане празно)</label>
                        <input type="file" class="form-control" multiple accept="image/jpeg, image/png, image/jpg" name="images[]">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="location" class="mb-2">Локација</label>
                        <select name="location_id" id="location" class="form-control">
                            @foreach ($locations as $location)
                                @if ($accommodation->location_id == $location->id)
                                    <option value="{{$location->id}}" selected>{{$location->country->name}}, {{$location->region}}</option>
                                @else
                                    <option value="{{$location->id}}">{{$location->country->name}}, {{$location->region}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="mb-2">Опис:</label>
                        <textarea name="description" cols="30" rows="8" class="form-control">{{$accommodation->description}}</textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Зачувај</button>
        </div>
    </form>
    <div class="row">
        @foreach ($accommodation->images as $image)
            <div class="col-2 p-3 d-flex flex-column">
                <img src="/{{$image->path}}" alt="img" style="width: 100%">
                <button class="btn btn-danger btn-sm delete-img-btns" id="{{$image->id}}-img">Избриши слика</button>
            </div>
        @endforeach
    </div>
</div>

<script src="/js/accommodation.js"></script>
@endsection


