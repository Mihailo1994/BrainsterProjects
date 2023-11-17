@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5">
    @if (session('status'))
    <div class="mb-5">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    @endif
    @if ($subscribers->isEmpty())
        <p>Нематe претплатници</p>
    @else
    <div class="p-4 border rounded border-primary">
    <table>
        <thead>
            <tr class="border-bottom">
                <th style="min-width: 120px" class="p-2">Име</th>
                <th style="min-width: 120px" class="p-2">Емаил</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
             @foreach ($subscribers as $subscriber)
                <tr class="border-bottom">
                    <td class="p-2">{{$subscriber->name}}</td>
                    <td class="p-2">{{$subscriber->email}}</td>
                    <td class="p-2">
                        <form action="{{route('subscribers.delete')}}" method="POST" class="d-inline">
                            @csrf
                            <input type="text" hidden readonly value="{{$subscriber->id}}" name="id">
                            <button class="btn btn-sm btn-danger">Избриши</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
</div>

@endsection

