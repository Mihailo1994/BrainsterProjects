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
    <div class="p-3 mb-3 border rounded border-primary container-fluid">
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="mb-3">
                        <label for="firstname" class="mb-2">Име</label>
                        <input type="text" name="firstname" id="firstname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="mb-2">Презиме</label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-2">Емаил</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="mb-2">Лозинка</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Зачувај</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection


