@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="form__container regLog__form form-login">
            <h2 class="form__title h3">Авторизация</h2>
            @yield('login')
        </div>
    </div>
@endsection
