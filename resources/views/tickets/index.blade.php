@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5">
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
    @if ($tickets->isEmpty())
        <p>Немате побарувања за билети</p>
    @else
    @foreach ($tickets as $ticket)
        <div class="row border rounded p-3 mb-3">
            <div class="col">
                @if ($ticket->status === 'pending')
                    <p class="text-warning">Статус: Во исчекување</p>
                @else
                    <p class="text-success">Статус: обработено</p>
                @endif
                <p>Име, Презиме: {{$ticket->firstname}} {{$ticket->lastname}}</p>
                <p>Емаил: {{$ticket->email}}</p>
                <p>Телефонски број: {{$ticket->phone_number}}</p>
                @if ($ticket->status === 'pending')
                <form action="{{route('tickets.confirm', $ticket->id)}}">
                    <button class="btn btn-primary">Обработи</button>
                </form>
                @endif
            </div>
            <div class="col">
                @if ($ticket->type == 'one way')
                    <p>Билет во еден правец</p>
                @else
                    <p>Повратен билет</p>
                @endif
                <p>Од: {{$ticket->from}}</p>
                <p>До: {{$ticket->to}}</p>
                <p>Датум на поаѓање: {{$ticket->travel_date}}</p>
                @if ($ticket->type != 'one way')
                <p>Датум на враќање: {{$ticket->return_date}}</p>
                @endif
                <p>Класа: {{$ticket->class}}</p>
            </div>
            <div class="col">
                <p>Возрасни: {{$ticket->n_of_adults}}</p>
                <p>Деца: {{$ticket->n_of_kids}}</p>
                <p>Бебиња: {{$ticket->n_of_babies}}</p>
            </div>
        </div>
    @endforeach
    @endif
@endsection

