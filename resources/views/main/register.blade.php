@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="form__container regLog__form form-login">
            <h2 class="form__title h3">Авторизация</h2>
            <form class="form__body" method="POST" action="/register">
                @csrf

                <h2>Регистрация</h2>

                @include('components.Input', [
                    'class' => 'regLog__input _switch',
                    'required' => true,
                    'placeholder' => 'Почта',
                    'type' => 'email',
                    'name' => 'email',
                    'label' => 'Почта',
                ])

                <!-- Фамилия -->
                <div class="regLog__textarea">
                    <label>
                        <p>Фамилия <span style="color: red">*</span></p>
                        <input type="text" name="surname" placeholder="Фамилия" required>
                    </label>
                </div>

                <!-- Имя -->
                <div class="regLog__textarea">
                    <label>
                        <p>Имя <span style="color: red">*</span></p>
                        <input type="text" name="name" placeholder="Имя" required>
                    </label>
                </div>

                <!-- Отчество -->
                <div class="regLog__textarea">
                    <label>
                        <p>Отчество</p>
                        <input type="text" name="oldname" placeholder="Отчество">
                    </label>
                </div>

                <!-- Телефон -->
                <div class="regLog__textarea">
                    <label>
                        <p>Номер телефона <span style="color: red">*</span></p>
                        <input type="tel" name="telephone" placeholder="Номер телефона" required>
                    </label>
                </div>

                <!-- Email -->
                <div class="regLog__textarea">
                    <label>
                        <p>Почта <span style="color: red">*</span></p>
                        <input type="email" name="email" placeholder="Почта" required>
                    </label>
                </div>

                <!-- Название училища -->
                <div class="regLog__textarea">
                    <label>
                        <p>Название училища</p>
                        <input type="text" name="companyName" placeholder="Название училища">
                    </label>
                </div>

                <!-- Описание училища -->
                <div class="regLog__textarea">
                    <label>
                        <p>Описание училища <span style="color: red">*</span></p>
                        <textarea name="companyDescription" placeholder="Описание училища" required maxlength="500"></textarea>
                    </label>
                </div>

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
