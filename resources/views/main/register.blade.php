@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="form__container regLog__form form-login">
            <h2 class="form__title h3">Регистрация</h2>
            <form class="form__body" method="POST" action="/register">
                @csrf

                <div class="form__inputs">

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

<<<<<<< HEAD
                    @include('components.Input', [
                        'class' => 'regLog__input',
                        'required' => false,
                        'placeholder' => 'Отчество',
                        'type' => 'text',
                        'name' => 'oldname',
                        'label' => 'Отчество',
                    ])

                    @include('components.Input', [
                        'class' => 'regLog__input',
                        'required' => false,
                        'placeholder' => 'Номер телефона',
                        'type' => 'tel',
                        'name' => 'telephone',
                        'label' => 'Номер телефона',
                    ])
=======
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
>>>>>>> 3eecb16528f6eafe1f623cfed9602c6279ba5e6c

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


<<<<<<< HEAD
                    @include('components.Textarea', [
                        'class' => 'regLog__textarea',
                        'required' => true,
                        'placeholder' => 'Название училища',
                        'type' => 'text',
                        'name' => 'companyName',
                        'label' => 'Название училища',
                    ])
=======
                @include('components.Textarea', [
                    'class' => 'regLog__textarea',
                    'required' => true,
                    'placeholder' => 'Описание училища',
                    'name' => 'companyDescription',
                    'label' => 'Описание училища',
                ])
>>>>>>> 3eecb16528f6eafe1f623cfed9602c6279ba5e6c


                    @include('components.Input', [
                        'class' => 'regLog__input',
                        'required' => true,
                        'placeholder' => 'Название училища',
                        'type' => 'text',
                        'name' => 'companyName',
                        'label' => 'Название училища',
                    ])

<<<<<<< HEAD
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
=======
                @include('components.Input', [
                    'class' => 'regLog__input',
                    'required' => true,
                    'placeholder' => 'Название училища',
                    'type' => 'text',
                    'name' => 'companyName',
                    'label' => 'Название училища',
                ])

                @include('components.Password', [
                    'class' => 'regLog__textarea',
                    'required' => true,
                    'placeholder' => 'Пароль',
                    'name' => 'password',
                    'label' => 'Пароль',
                ])

                @include('components.Password', [
                    'class' => 'regLog__textarea',
                    'required' => true,
                    'placeholder' => 'Повторите пароль',
                    'name' => 'password_confirmation',
                    'label' => 'Повторите пароль',
                ])

<<<<<<< HEAD
                <!-- Повтор пароля -->
                <div class="regLog__textarea">
                    <label>
                        <p>Повторите пароль <span style="color: red">*</span></p>
                        <div style="position: relative">
                            <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                            <div class="input-password__icon" onclick="togglePassword(this)">
                                <img class="icon" src="{{ asset('img/icons/eye.svg') }}" alt="">
>>>>>>> 3eecb16528f6eafe1f623cfed9602c6279ba5e6c
                            </div>
                        </label>
                    </div>
=======
>>>>>>> a740357ea1a528e3630084f69e3516fdfa691721

                    <!-- Повтор пароля -->
                    <div class="regLog__textarea">
                        <label>
                            <p>Повторите пароль <span style="color: red">*</span></p>
                            <div style="position: relative">
                                <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
                                <div class="input-password__icon" onclick="togglePassword(this)">
                                    <img class="icon" src="{{ asset('img/icons/eye.svg') }}" alt="">
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Кнопка отправки -->
                    <div class="form__actions">
                        <button type="submit" class="form__button _btn _blue">Регистрация</button>
                    </div>

                    <div class="form__disciption">
                        <p class="regLog__description">
                            У вас есть аккаунт? <a href="{{ route('login') }}">Войти</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // переключатель пароля
        function togglePassword(button) {
            const input = button.previousElementSibling;
            const iconoEye = button.querySelector('.icon');

            console.log(iconoEye)

            input.type = input.type === 'password' ? 'text' : 'password';
            iconoEye.src = input.type === 'password' ? 'http://127.0.0.1:8000/img/icons/eye.svg' :
                'http://127.0.0.1:8000/img/icons/eye-slash.svg';
        }
    </script>
@endsection
