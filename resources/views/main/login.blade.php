@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="form__container regLog__form form-login">
            <h2 class="form__title h3">Авторизация</h2>
            <form class="form__body">
                <div class="form__inputs">
                    <div class="regLog__form-btns">
                        <div class="regLog__form-btn _active">Админ</div>
                        <div class="regLog__form-btn">Ментор</div>
                    </div>

                    @include('components.Input', [
                        'class' => 'regLog__input _switch',
                        'required' => true,
                        'placeholder' => 'Почта',
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Почта',
                    ])

                    @include('components.Input', [
                        'class' => 'regLog__input',
                        'required' => true,
                        'placeholder' => 'Пароль',
                        'type' => 'password',
                        'name' => 'password',
                        'label' => 'Пароль',
                    ])

                    <div class="form__actions">
                        <button type="submit" class="form__button _btn _blue">Войти</button>
                    </div>

                    <div class="form__disciption">
                        <p class="regLog__description">
                            У вас нету аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
