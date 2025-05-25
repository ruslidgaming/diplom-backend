@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="form__container regLog__form form-login">
            <h2 class="form__title h3">Авторизация</h2>
            <form class="form__body" method="POST" action="/register">
                @csrf

                <h2>Регистрация</h2>

                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Фамилия',
                    'type' => 'text',
                    'name' => 'surname',
                    'label' => 'Фамилия',
                ])

                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Имя',
                    'type' => 'text',
                    'name' => 'name',
                    'label' => 'Имя',
                ])

                @include('components.Input', [
                    'class' => 'regLog__input',
                    'placeholder' => 'Отчество',
                    'type' => 'text',
                    'name' => 'oldname',
                    'label' => 'Отчество',
                ])

                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Номер телефона',
                    'type' => 'tel',
                    'name' => 'telephone',
                    'label' => 'Номер телефона',
                ])

                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Почта',
                    'type' => 'email',
                    'name' => 'email',
                    'label' => 'Почта',
                ])


                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Название училища',
                    'type' => 'text',
                    'name' => 'companyName',
                    'label' => 'Название училища',
                ])


                @include('components.Textarea', [
                    'class' => 'regLog__textarea',
                    'required' => true,
                    'placeholder' => 'Описание училища',
                    'name' => 'companyDescription',
                    'label' => 'Описание училища',
                ])


                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Название училища',
                    'type' => 'text',
                    'name' => 'companyName',
                    'label' => 'Название училища',
                ])


                <!-- Пароль -->
                <div class="regLog__textarea">
                    <label>
                        <p>Пароль <span style="color: red">*</span></p>
                        <div style="position: relative">
                            <input type="password" name="password" placeholder="Пароль" required minlength="6"
                                maxlength="20">
                            <button type="button" class="input-password__icon" onclick="togglePassword(this)">
                                👁
                            </button>
                        </div>
                    </label>
                </div>

                <!-- Повтор пароля -->
                <div class="regLog__textarea">
                    <label>
                        <p>Повторите пароль <span style="color: red">*</span></p>
                        <div style="position: relative">
                            <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                            <div class="input-password__icon" onclick="togglePassword(this)">
                                <img class="icon" src="{{ asset('img/icons/eye.svg') }}" alt="">
                            </div>
                            <button type="button" class="input-password__icon">
                                👁
                            </button>
                        </div>
                    </label>
                </div>

                <!-- Кнопка отправки -->
                <button type="submit">Регистрация</button>
            </form>
        </div>
    </div>
@endsection
