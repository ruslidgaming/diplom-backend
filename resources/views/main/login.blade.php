@extends('layouts.main')

@section('content')
    <div className="container">
        <div className="form__container regLog__form form-login">
            <h2 className="form__title h3">Авторизация</h2>

            <form className="form__body" onSubmit={handleSubmit}>
                <div className="form__inputs">

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

                    <div className="form__actions">
                        <button type="submit" className="form__button _btn _blue">Войти</button>
                    </div>

                    <div className="form__disciption">
                        <p className="regLog__description">
                            У вас нету аккаунта? <a href="/register">Зарегистрироваться</a>
                            <br />
                            или <a href="/profile">Войти</a>
                        </p>
                    </div>
            </form>
        </div>
    </div>
@endsection
