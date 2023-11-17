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
    <form action="{{route('accommodation.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="mb-2">Име на сместувањето</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="mb-2">Рејтинг</label>
                        <select name="rating" class="form-control" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="accommodation_type" class="mb-2">Тип на сместување</label>
                        <select name="accommodation_type" class="form-control" id="accommodation_type">
                            @foreach($accommodationTypes as $type)
                                <option value="{{$type->id}}">{{$type->type_of_accommodation}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="mb-2">Слики:</label>
                        <input type="file" class="form-control" multiple accept="image/jpeg, image/png, image/jpg" name="images[]">
                    </div>
                    <button class="btn btn-primary" type="submit">Зачувај</button>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="location" class="mb-2">Локација</label>
                        <select name="location_id" id="location" class="form-control">
                            <option selected disabled>Држава, Регион...</option>
                            @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->country->name}}, {{$location->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="mb-2">Опис:</label>
                        <textarea name="description" cols="30" rows="8" class="form-control"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>


@endsection


