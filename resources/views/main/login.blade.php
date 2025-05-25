import { observer } from "mobx-react-lite";
import loginModel from "./models/login-model.jsx";
import FromRegLog from "../../layout/components/form.jsx";
import DivInput from "../../../core/UIKit/input.jsx";
import { Link } from "react-router-dom";
import { useState } from "react";
import Icon from "../../../core/UIKit/icons.jsx";
import { useAuth } from "../../../core/hoc/AuthProvider.jsx";
import { useForm } from "react-hook-form";  

function Login() {
    const { setLogin, role, setRole } = loginModel;

    const { signin } = useAuth();

    const [showPassword, setShowPassword] = useState(false);

    const togglePasswordVisibility = () => {
        setShowPassword(prevState => !prevState);
    }
    const {
        register,
        formState: {
            errors,
            isValid,
            isSubmitting,
        },
        handleSubmit,
        getValues,
    } = useForm({
        mode: "onSubmit",
    });

    const handleSubmitForm = (data) => {
        setLogin(signin, data)
    }

    return <>

        <FromRegLog className="regLog__form" formType="login" formTitle="Авторизация" submitText="Войти" onSubmit={handleSubmit(handleSubmitForm)} disciption={
            <p className="regLog__description">
                У вас нету аккаунта? <a href="/register">Зарегистрироваться</a>
                <br />
                или <a href="/profile">Войти</a>
            </p>
        }>

            <div className="regLog__form-btns">
                <div className={`regLog__form-btn ${role == 'admin' && '_active'}`} onClick={() => setRole("admin")}>Админ</div>
                <div className={`regLog__form-btn ${role == 'mentor' && '_active'}`} onClick={() => setRole("mentor")}>Ментор</div>
            </div>

            <DivInput className="regLog__input" label={<p>{role == 'admin' ? "Почта" : "Логин"} <span style={{ color: "red" }}>*</span></p>}>

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

            <DivInput className="regLog__textarea" label={<p>Пароль <span style={{ color: "red" }}>*</span></p>}>
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

                <div className="input-password__icon" onClick={togglePasswordVisibility}>
                    <Icon name={showPassword ? "eye-slash" : "eye"} />
                </div>
            </DivInput>
            {errors?.password && (<p style={{ color: "red" }}>{errors?.password?.message}</p>)}

        </FromRegLog>

    </>

}

export default observer(Login);