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


                <!-- Кнопка отправки -->
                <button type="submit">Регистрация</button>
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
