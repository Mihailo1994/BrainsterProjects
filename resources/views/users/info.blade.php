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
    <div class="border rounded border-primary p-3">
        <div>
            <p class="h5 mb-5">Профил</p>
            <p>Име: {{$user->firstname}}</p>
            <p>Презиме: {{$user->lastname}}</p>
            <p>Емаил: {{$user->email}}</p>
        </div>
        <div>
            <a href="{{route('users.password')}}" class="btn-primary btn text-decoration-none">Промени лозинка</a>
        </div>
    </div>
</div>


@endsection


