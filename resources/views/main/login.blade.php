        <FromRegLog class="regLog__form" formType="login" formTitle="Авторизация" submitText="Войти" onSubmit={handleSubmit(handleSubmitForm)} disciption={
            <p class="regLog__description">
                У вас нету аккаунта? <a href="/register">Зарегистрироваться</a>
                <br />
                или <a href="/profile">Войти</a>
            </p>
        }>

            <div class="regLog__form-btns">
                <div class={`regLog__form-btn ${role == 'admin' && '_active'}`} onClick={() => setRole("admin")}>Админ</div>
                <div class={`regLog__form-btn ${role == 'mentor' && '_active'}`} onClick={() => setRole("mentor")}>Ментор</div>
            </div>

            <DivInput class="regLog__input" label={<p>{role == 'admin' ? "Почта" : "Логин"} <span style={{ color: "red" }}>*</span></p>}>

                {role == 'admin' ?
                    <input placeholder="Почта"
                        type="email"
                        {...register('email', {
                            required: "Поле обязательно",
                            pattern: {
                                value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'Не корректная почта',
                            },
                            maxLength: {
                                value: 100,
                                message: "Максимум 100 символов",
                            }
                        })} />
                    :
                    <input placeholder="Логин"
                        type="text"
                        {...register('login', {
                            required: "Поле обязательно",
                            maxLength: {
                                value: 100,
                                message: "Максимум 100 символов",
                            }
                        })} />
                }

            </DivInput>
            {errors?.email && (<p style={{ color: "red" }}>{errors?.email?.message}</p>)}

            <DivInput class="regLog__textarea" label={<p>Пароль <span style={{ color: "red" }}>*</span></p>}>
                <input type={showPassword ? "text" : "password"} placeholder="Название училища"
                    {...register('password', {
                        required: "Поле обязательно",
                        maxLength: {
                            value: 20,
                            message: "Максимум 20 символов",
                        },
                        minLength: {
                            value: 6,
                            message: "Минимум 6 символов",
                        }
                    })} />

                <div class="input-password__icon" onClick={togglePasswordVisibility}>
                    <Icon name={showPassword ? "eye-slash" : "eye"} />
                </div>
            </DivInput>
            {errors?.password && (<p style={{ color: "red" }}>{errors?.password?.message}</p>)}

        </FromRegLog>