@extends('layout.layout')

@section('title', 'Login')

@section('content')

    <div class="container-fluid py-5 min-height bg-grey">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-10">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div class="border rounded">
                    <div class="p-3 border-bottom">
                        <p class="mb-0 fw-bold text-center">Infinity Travel</p>
                    </div>
                    <div class="p-3 bg-white">
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="row justify-content-center mb-3">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="username" class="mt-2">Email</label>
                                </div>
                                <div class="col-7">
                                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-3 d-flex justify-content-end">
                                    <label for="password" class="mt-2">Password</label>
                                </div>
                                <div class="col-7">
                                    <input type="password" id="password" name="password" class="form-control mb-3">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
