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
    <div class="p-4 border rounded mb-3 accommodation-link">
        <form action="{{route('testimonial.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label class="m-2">Наслов</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="m-2">Слика</label>
                        <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/jpg">
                    </div>
                    <div class="mb-3">
                        <label class="m-2">Опис</label>
                        <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="m-2">Рејтинг</label>
                        <select name="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="m-2">Аранжман</label>
                        <input type="test" name="arrangement" class="form-control">
                    </div>
                    <button class="btn btn-primary" type="submit">Зачувај</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

