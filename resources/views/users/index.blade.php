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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="mb-3">
        <a href="{{route('users.add')}}" class="text-decoration-none text-black"><button class="btn btn-primary">Додади корисник</button></a>
    </div>
    <div class="p-3 mb-3 border rounded border-primary">
        @if ($users->isEmpty())
            <p>Нема постоечки корисници</p>
        @else
        <table>
            <thead>
                <tr class="border-bottom">
                    <th style="min-width: 120px" class="p-2">Име</th>
                    <th style="min-width: 120px" class="p-2">Презиме</th>
                    <th style="min-width: 120px" class="p-2">Емаил</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($users as $user)
                    <tr class="border-bottom">
                        <td class="p-2">{{$user->firstname}}</td>
                        <td class="p-2">{{$user->lastname}}</td>
                        <td class="p-2">{{$user->email}}</td>
                        <td class="p-2">
                            <form action="{{route('users.delete')}}" method="POST" class="d-inline">
                                @csrf
                                <input type="text" hidden readonly value="{{$user->id}}" name="id">
                                <button class="btn btn-sm btn-danger">Избриши корисник</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>


@endsection


