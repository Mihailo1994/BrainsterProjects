@extends('layout.layout')

@section('title', 'Infinity Travel')

@include('layout.nav')

@section('content')

<div class="p-5 container-fluid">
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
    <div class="row border rounded p-4 mb-3">
        <div class="col">
            <p>{{$accommodation->name}}</p>
            <p>Локација: {{$accommodation->location->country->name}}, {{$accommodation->location->region}}</p>
            <p>Тип на сместување: {{$accommodation->accommodationType->type_of_accommodation}}</p>
            <p>Рејтинг
            @php
                $n = $accommodation->rating;
            @endphp
            @for ($i = 1; $i <= $n; $i++)
                <i class="fa-solid fa-star"></i>
            @endfor
            @if ($accommodation->last_minute === 0)
            <div>
                <p class="d-inline me-3">Додади во Last Minute понуда</p>
                <form action="{{route('accommodation.offer.add')}}" method="POST" class="d-inline">
                    @csrf
                    <input type="text" name="id" readonly hidden value="{{$accommodation->id}}">
                    <button type="submit" class="btn btn-primary">Додади</button>
                </form>
            </div>
            @else
            <div>
                <p class="d-inline me-3">Отстрани од Last Minute понуда</p>
                <form action="{{route('accommodation.offer.remove')}}" method="POST" class="d-inline">
                    @csrf
                    <input type="text" name="id" readonly hidden value="{{$accommodation->id}}">
                    <button type="submit" class="btn btn-primary">Отстрани</button>
                </form>
            </div>
            @endif
            </p>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#accommodationModal">Избриши</button>
            <a href="{{url('accommodation/edit/'.$accommodation->id)}}" class="btn btn-warning">Измени сместување</a>
            <a href="{{route('termin.add', $accommodation->id)}}" class="btn btn-primary">Додади термини</a>
        </div>
        <div class="col-auto">
            @foreach ($accommodation->images as $image)
                <img style="width: 100px" src="/{{$image->image_path}}" alt="img">
            @endforeach
        </div>
    </div>
    <div class="row border rounded p-4">
        @if ($accommodation->termins->isEmpty())
            <p>Немате термини. Додадете нови термини</p>
        @else
        <div class="col">
            <table class="">
                <thead>
                    <tr class="border-bottom">
                        <th style="min-width: 120px" class="p-2">Термин од</th>
                        <th style="min-width: 120px" class="p-2">Термин до</th>
                        <th style="min-width: 120px" class="p-2">Цена од ноќ</th>
                        <th style="min-width: 120px" class="p-2">Статус</th>
                        <th style="min-width: 120px" class="p-2">Забелешка</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($accommodation->termins as $termin)
                    <tr class="border-bottom">
                        <td class="p-2">{{$termin->date_from}}</td>
                        <td class="p-2">{{$termin->date_until}}</td>
                        <td class="p-2">{{$termin->price_per_night}}</td>
                        @if ($termin->is_reserved == true)
                        <td class="p-2 text-danger">Резервиран</td>
                        @elseif($termin->is_reserved == false)
                        <td class="p-2 text-success">Слободен</td>
                        @endif
                        <td class="p-2 note" id="note-{{$termin->id}}">{{$termin->note}}</td>
                        <td>
                            @if ($termin->is_reserved == false)
                                <form action="{{route('termin.reserve', $termin->id)}}" method="POST" class="d-inline mx-1">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Резервирај</button>
                                </form>
                            @elseif($termin->is_reserved == true)
                                <form action="{{route('termin.reserve', $termin->id)}}" method="POST" class="d-inline mx-1">
                                    @csrf
                                    <button class="btn btn-warning btn-sm">Откажи</button>
                                </form>
                            @endif
                        </td>
                        <td class="mx-2">
                            <form action="{{route('termin.delete', $termin->id)}}" method="POST" class="d-inline mx-1">
                                 @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Избриши</button>
                            </form>
                        </td>
                        <td><button class="btn btn-sm btn-warning mx-1 edit-btn">Едитирај</button></td>
                        <td><button class="btn btn-info btn-sm mx-1 add-note">Забелешка</button></td>
                    </tr>
                    <tr class="border-bottom d-none">
                        <form method="POST" action="{{route('termin.update', $termin->id)}}">
                            @csrf
                            <td class="p-2">
                                <input type="date" class="form-control" name="date_from" value="{{$termin->date_from}}">
                            </td>
                            <td class="p-2">
                                <input type="date" class="form-control" name="date_until" value="{{$termin->date_until}}">
                            </td>
                            <td class="p-2">
                                <input type="number" name="price_per_night" class="form-control" value="{{$termin->price_per_night}}">
                            </td>
                            @if ($termin->is_reserved == true)
                                <td class="p-2 text-danger">Резервиран</td>
                            @elseif($termin->is_reserved == false)
                                <td class="p-2 text-success">Слободен</td>
                            @endif
                            <td class="p-2">
                                <input type="text" name="note" class="form-control" value="{{$termin->note}}">
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm">Зачувај</button>
                                <button class="btn btn-primary cancel-edit btn-sm">Откажи</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>


<div class="modal fade" id="accommodationModal" tabindex="-1" aria-labelledby="accommodationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p>Со бришење на сместувањето ке бидат избришани сите термини и слики поврзани со сместувањето. <br> Дали сте сигурни дека сакате да го избришете ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Откажи</button>
                <form action="{{route('accommodation.delete', $accommodation->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Избриши</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="/js/accommodation.js"></script>
@endsection


