import { observer } from "mobx-react-lite";
import { useEffect, useState } from "react";
import { useForm, Controller } from "react-hook-form";
import DivInput from "../../../core/UIKit/input";
import foto from "../../../assets/img/banner.png";
import courseModal from "./models/course-modal";
import { courseCreate, courseShow } from "./service/course-service";
import { useAuth } from "../../../core/hoc/AuthProvider";
import { useParams } from "react-router-dom";
import loadableModel from "../../../core/UIKit/loadable/Loadable";
import Example from "./components/LottieAnimation";
import { toast } from "react-toastify";

function CoursesEditForm() {

    const { showCourseData, showCourseTeacherData, setShowCourseData, setTeacherDelete } = courseModal;
    const { idCourse } = useParams();

    const { isLoading, setLoadable } = loadableModel

    const {
        register,
        control,
        handleSubmit,
        formState: { errors },
        reset,
        setValue,
        getValues,
        setValues
    } = useForm({
        defaultValues: {
            title: "",
            price: "",
            cardDescription: "",
            slogan: "",
            aboutCourse: "",
        },
        mode: "onSubmit",
    });

    useEffect(() => {
        courseShow(idCourse)
            .then(res => {
                setShowCourseData(res)
                console.log(res.data['course'])
                setCourseCards(JSON.parse(res.data['course'].course_info))
                setValue("title", res.data['course'].name)
                setValue("price", res.data['course'].price)
                setValue("cardDescription", res.data['course'].mini_description)
                setValue("slogan", res.data['course'].slogan)
                setValue("aboutCourse", res.data['course'].description)
            })
            .catch(err => {
                console.log(err)
            }).finally(() => {
                setLoadable(false)
            })
    }, [])

    // Модели данных
    const [courseCards, setCourseCards] = useState([]);
    const [mentorCards, setMentorCards] = useState([]);
    const [courseImagePreview, setCourseImagePreview] = useState(null);
    const [mentorImagePreviews, setMentorImagePreviews] = useState({});



    // Валидационные схемы
    const validationRules = {
        title: { required: "Название обязательно" },
        price: {
            required: "Цена обязательна",
            min: { value: 0, message: "Цена не может быть отрицательной" },
        },
        cardDescription: {
            required: "Описание обязательно",
            maxLength: { value: 150, message: "Максимум 150 символов" },
        },
        slogan: { required: "Слоган обязателен" },
        aboutCourse: { required: "Описание курса обязательно" },
    };

    const onSubmit = async (data) => {
        const formData = new FormData();

        formData.append("title", data.title);
        formData.append("price", data.price);
        formData.append("cardDescription", data.cardDescription);
        formData.append("slogan", data.slogan);
        formData.append("aboutCourse", data.aboutCourse);
        formData.append("courseCards", JSON.stringify(courseCards));
        data.courseCards = courseCards
        formData.append("mentorCards", JSON.stringify(mentorCards));
        data.mentorCards = mentorCards

        getValues("courseImage")[0] && formData.append("courseImage", getValues("courseImage")[0]);

        let countImg = 0;

        mentorCards.forEach((mentor, index) => {
            console.log(mentor)
            if (mentor.image) {
                console.log(mentor.image)
                formData.append(`mentorImage_${index}`, mentor.image);
                countImg++;
            }
        });
        formData.append(`count`, countImg);
        formData.append('idCourse', showCourseData.id)
        try {
            const response = await fetch('http://127.0.0.1:8000/api/course/update', {
                method: 'POST',
                body: formData,
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                }
            });

            const result = await response.json();
            console.log('Server response:', result);
            toast.success('Курсы обновлены')
            // window.location.href = '/admin/courses';

        } catch (error) {
            console.error('Error uploading file:', error);
        }
    };


    // Добавление карточки курса
    const addCourseCard = (data) => {
        const newCard = {
            title: getValues("courseCardTitle"),
            description: getValues("courseCardDescription"),
        };

        if (newCard.title && newCard.description) {
            setCourseCards([...courseCards, newCard]);
            setValue("courseCardTitle", '')
            setValue("courseCardDescription", '')
        }
    };

    // Удаление карточки курса
    const removeCourseCard = (index) => {
        setCourseCards(courseCards.filter((_, i) => i !== index));
    };

    // Добавление карточки ментора
    const addMentorCard = (data) => {
        const newMentor = {
            name: getValues("mentorName"),
            description: getValues('mentorDescription'),
            image: getValues('mentorImage') ? getValues('mentorImage')[0] : null,
        };

        if (newMentor.name && newMentor.description) {
            setMentorCards([...mentorCards, newMentor]);
            setValue("mentorName", '')
            setValue("mentorDescription", '')
            setValue("mentorImage", '')
        }
    };

    // Удаление карточки ментора
    const removeMentorCard = (index) => {
        setMentorCards(mentorCards.filter((_, i) => i !== index));
    };

    return (
        isLoading ?
            <Example /> :
            <>
                <div className="addcours">
                    <div>
                        <div className="addcours__title">Оформление карточки</div>

                        <div className="addcours-card__face _fonBack-navy__blue">
                            <div>
                                <div className="addcours-card__img">
                                    <input
                                        type="file"
                                        id="cours__foto"
                                        style={{ display: "none" }}
                                        accept="image/*"
                                        {...register("courseImage", {
                                            onChange: (e) => {
                                                const file = e.target.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = () => setCourseImagePreview(reader.result);
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                        })}
                                    />
                                    <label htmlFor="cours__foto">
                                        {courseImagePreview ? (
                                            <img
                                                className="addcours-card__face-img"
                                                src={courseImagePreview}
                                                alt="Preview"
                                                style={{ width: 350, height: 350, objectFit: 'cover' }}
                                            />
                                        ) : (
                                            <img className="addcours-card__face-img" src={`http://127.0.0.1:8000/storage/${showCourseData.image}`} />
                                        )}
                                    </label>
                                    {errors.courseImage && (
                                        <p style={{ color: "red" }}>{errors.courseImage.message}</p>
                                    )}
                                </div>
                            </div>

                            <div className="addcours-card__face-inps">
                                <DivInput className="addcours__inp" label={<p>Название</p>}>
                                    <input
                                        className="addcours-card__face-inp"
                                        placeholder="Название"
                                        {...register("title", validationRules.title)}
                                    />
                                </DivInput>
                                {errors.title && (
                                    <p style={{ color: "red" }}>{errors.title.message}</p>
                                )}
                                <DivInput className="addcours__inp" label={<p>Цена</p>}>
                                    <input
                                        type="number"
                                        className="addcours-card__face-inp"
                                        placeholder="Цена"
                                        {...register("price", validationRules.price)}
                                    />
                                </DivInput>
                                {errors.price && (
                                    <p style={{ color: "red" }}>{errors.price.message}</p>
                                )}

                                <DivInput className="addcours__inp _textarea" label={<p>Описание для карточки</p>}>
                                    <textarea
                                        className="addcours-card__face-inp"
                                        placeholder="Описание карточки"
                                        {...register("cardDescription", validationRules.cardDescription)}
                                    />
                                </DivInput>
                                {errors.cardDescription && (
                                    <p style={{ color: "red" }}>{errors.cardDescription.message}</p>
                                )}
                            </div>
                        </div>

                        <div className="addcours__title">Слоган для баннера</div>
                        <div className="addcours__about _slogan _fonBack-navy__blue">
                            <textarea
                                className="addcours__about-textarea"
                                placeholder="Слоган"
                                {...register("slogan", validationRules.slogan)}
                            />
                        </div>
                        {errors.slogan && (
                            <p style={{ color: "red" }}>{errors.slogan.message}</p>
                        )}

                        <div className="addcours__title">Блок с информацией об курсе</div>
                        <div className="addcours__about _fonBack-navy__blue">
                            <textarea
                                className="addcours__about-textarea"
                                placeholder="О курсе"
                                {...register("aboutCourse", validationRules.aboutCourse)}
                            />
                        </div>
                        {errors.aboutCourse && (
                            <p style={{ color: "red" }}>{errors.aboutCourse.message}</p>
                        )}

                        <div className="addcours__title">Карточки "Что проходим на курсе"</div>
                        <div className="addcours-info__items">
                            <div className="addcours-info__item _create">
                                <DivInput className="addcours-info__title">
                                    <input
                                        className="addcours-info__inp"
                                        placeholder="Название"

                                        {...register("courseCardTitle")}
                                    />
                                </DivInput>

                                <DivInput className="addcours-info__text">
                                    <textarea
                                        className="addcours-info__textarea"
                                        placeholder="Описание карточки"
                                        {...register("courseCardDescription")}
                                    />
                                </DivInput>
                                <button
                                    type="button"
                                    className="addcours-info__create"
                                    onClick={addCourseCard}
                                >
                                    Добавить
                                </button>
                            </div>

                            {courseCards.map((card, index) => (
                                <div className="addcours-info__item" key={index}>
                                    <p className="addcours-info__title">{card.title}</p>
                                    <p className="addcours-info__text">{card.description}</p>
                                    <button
                                        type="button"
                                        className="addcours-info__delete"
                                        onClick={() => removeCourseCard(index)}
                                    >
                                        Удалить
                                    </button>
                                </div>
                            ))}
                        </div>

                        <div className="addcours__title">Блок с информацией об менторах</div>
                        <div className="addcours__mentors _fonBack-navy__blue">
                            <div className="addcours__mentors-items">
                                <div className="addcours__mentors-item item-mentors _create">
                                    <label className="item-mentors__foto _create">
                                        <label>Фото</label>
                                        <input
                                            type="file"
                                            className="item-mentors__foto-file"
                                            onChange={(e) => {
                                                const file = e.target.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = () => {
                                                        setMentorImagePreviews(prev => ({
                                                            ...prev,
                                                            [Date.now()]: reader.result // Используем временный ключ
                                                        }));
                                                        // Сохраняем файл в form через setValue
                                                        setValue("mentorImage", [file]);
                                                    };
                                                    reader.readAsDataURL(file);
                                                }
                                            }}
                                        />
                                        {mentorImagePreviews.temp && (
                                            <img
                                                src={mentorImagePreviews.temp}
                                                alt="Preview"
                                                style={{ width: 100, height: 100, objectFit: 'cover' }}
                                            />
                                        )}
                                    </label>

                                    <DivInput className="item-mentors__title">
                                        <input
                                            className="addcours-info__inp"
                                            placeholder="Имя"
                                            {...register("mentorName")}
                                        />
                                    </DivInput>
                                    <DivInput className="item-mentors__info">
                                        <textarea
                                            className="addcours-card__face-inp"
                                            placeholder="Описание карточки"
                                            {...register("mentorDescription")}
                                        />
                                    </DivInput>
                                    <button
                                        type="button"
                                        className="item-mentors__btn _btn _blue _create"
                                        onClick={addMentorCard}
                                    >
                                        Добавить
                                    </button>
                                </div>

                                {mentorCards.map((mentor, index) => (
                                    <div className="addcours__mentors-item item-mentors" key={index}>
                                        <div className="item-mentors__foto">
                                            {mentor.image ? (
                                                <img
                                                    src={typeof mentor.image === 'string'
                                                        ? mentor.image
                                                        : URL.createObjectURL(mentor.image)}
                                                    alt="Mentor"
                                                />
                                            ) : (
                                                <img src={foto} alt="Default" />
                                            )}
                                        </div>
                                        <div className="item-mentors__name">{mentor.name}</div>
                                        <div className="item-mentors__about">{mentor.description}</div>
                                        <button
                                            type="button"
                                            className="item-mentors__btn _btn _red _create"
                                            onClick={() => removeMentorCard(index)}
                                        >
                                            Удалить
                                        </button>
                                    </div>
                                ))}

                                {showCourseTeacherData?.map((mentor, index) => (
                                    <div className="addcours__mentors-item item-mentors" key={index}>
                                        <div className="item-mentors__foto">
                                            <img src={`http://127.0.0.1:8000/storage/${mentor.image}`} alt="" />
                                        </div>
                                        <div className="item-mentors__name">{mentor.name}</div>
                                        <div className="item-mentors__about">{mentor.description}</div>
                                        <button
                                            type="button"
                                            className="item-mentors__btn _btn _red _create"
                                            onClick={() => setTeacherDelete(mentor.id)}
                                        >
                                            Удалить
                                        </button>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* <button type="submit" className="addcours__submit" onClick={onSubmit}> */}
                        <button type="submit" className="addcours__submit" onClick={handleSubmit(onSubmit)}>
                            Сохранить курс
                        </button>
                        <a href="../" className="addcours__submit _btn ">Назад</a>
                    </div>
                </div>
            </>
    );
}

export default observer(CoursesEditForm);