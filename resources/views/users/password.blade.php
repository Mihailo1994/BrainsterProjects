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
    <div class="border rounded border-primary p-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{route('users.password.change')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-2">Стара лозинка</label>
                        <input type="password" name="old_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="mb-2">Нова лозинка</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <button class="btn btn-primary">Зачувај</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


