@extends('main.login')

@section('login')
    <form class="form__body" method="POST" action="{{ route('login.admin.action') }}">
        @csrf
        <div class="form__inputs">
            <div class="regLog__form-btns">
                <a href="{{ route('login.admin') }}" class="regLog__form-btn _active">Админ</a>
                <a href="{{ route('login.metodist') }}" class="regLog__form-btn">Ментор</a>
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
@endsection
