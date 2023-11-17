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
        <a href="{{route('testimonial.add')}}" class="btn btn-primary">Додади тестимониал</a>
    </div>
    @if ($testimonials->isEmpty())
        <p>Нематe тестимониали. Додадете нови</p>
    @else
    @foreach ($testimonials as $testimonial)
    <div class="row border rounded p-4  mb-3">
        <div class="col-2">
            <img src="/{{$testimonial->image}}" alt="" style="width: 100%">
        </div>
        <div class="col-10">
            <p class="h5">Наслов: {{$testimonial->title}}</p>
            <p>Рејтинг: {{$testimonial->rating}}</p>
            <p>Опис: <br>{{$testimonial->description}}</p>
            <p class="h5">Аранжман: {{$testimonial->arrangement}}</p>
            <form action="{{route('testimonial.delete', $testimonial->id)}}" method="POST">
                @csrf
                <button class="btn btn-danger" type="submit">Избриши</button>
            </form>
        </div>
    </div>
    @endforeach
    @endif
</div>

@endsection

