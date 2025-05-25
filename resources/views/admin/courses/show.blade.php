import { observer } from "mobx-react-lite";
import { Link, useParams } from "react-router-dom";
import Icon from "../../../core/UIKit/icons";
import { useEffect, useRef, useState } from "react";
import { courseShow } from "./service/course-service";

// ===Swiper===
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import courseModal from "./models/course-modal";
import Example from "./components/LottieAnimation";
import loadableModel from "../../../core/UIKit/loadable/Loadable";

function CoursesShow() {

const { showCourseData, setShowCourseData, showCourseTeacherData } = courseModal;
const { isLoading, setLoadable } = loadableModel

const { idCourse } = useParams();
useEffect(() => {
courseShow(idCourse)
.then(res => {
setShowCourseData(res)
})
.catch(err => {
console.log(err)
})
.finally(() => {
setLoadable(false)
})
}, [])

const swiperRef = useRef(null)
const slideClickPrev = () => {
swiperRef.current.swiper.slidePrev()
}
const slideClickNext = () => {
swiperRef.current.swiper.slideNext()
}


return (isLoading ?
<Example />
:
<>

    <section class="banner-show _course">
        <div class="banner-show__word  _py">
            <h3>{showCourseData["name"]}</h3>
            <h2>{showCourseData['slogan']}</h2>
            <a class="banner__btn _btn _blue" href="#rate">Купить</a>
            <a class="banner-show__errow">
                <span>V</span>
                <span>V</span>
                <span>V</span>
            </a>
        </div>
    </section>

    <section class="banner-show__about _py " id="about">
        <h3 class="_700"><span>О курсе</span></h3>
        <p class="_text-lvl_1">{showCourseData['description']}</p>
    </section>

    {showCourseData['course_info'] &&

    <section class="banner-show__technologies  _py">
        <h3 class="technologies__title _700"><span>Технологии</span> изучаемые в процессе обучения</h3>

        <div class="technologies__cards">

            {showCourseData['course_info']?.map((item, index) => (
            <div class="technologies__card _fonBack-navy__blue _hover" key={index}>
                <h6 class="technologies__name _700">{item.title}</h6>
                <p class="technologies__text">{item.description}</p>
            </div>
            ))}
        </div>
    </section>
    }

    <section class="banner-show__technologies _content _py">
        <h2 class="technologies__title _700">Вас ждут <span>8</span>
            {/* <?php if (count($listTheory) == 1) {
                echo 'урок';
            } elseif (count($listTheory) > 1 && count($listTheory) < 5) {
                echo 'урока';
            } else {
                echo 'уроков';
            }
            ?> */}
        </h2>

        <div class="lesson__cards">
            <div class="technologies__card _fonBack-navy__blue _hover">
                <p class="_text-lvl_3">Урок 1</p>
            </div>
            <div class="technologies__card _fonBack-navy__blue _hover">
                <p class="_text-lvl_3">Урок 1</p>
            </div>
            <div class="technologies__card _fonBack-navy__blue _hover">
                <p class="_text-lvl_3">Урок 1</p>
            </div>
            <div class="technologies__card _fonBack-navy__blue _hover">
                <p class="_text-lvl_3">Урок 1</p>
            </div>
        </div>
    </section>
    {<section class="banner-show__technologies _py" id="teacher">
        <div class="teacher__header">
            <h2 class="technologies__title _700"><span>Ваши</span> наставники</h2>
            <div class="constructor__btns">
                {showCourseTeacherData?.length > 4 &&
                <>
                    <button class="constructor__btn btn-prev" onClick={slideClickPrev}>
                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="70" height="70" rx="35" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M40.2643 23.903C39.5633 23.2021 38.4604 23.1482 37.6976 23.7413L37.5144 23.903L27.7922 33.6252C27.0912 34.3262 27.0373 35.4291 27.6304 36.1919L27.7922 36.3751L37.5144 46.0973C38.2737 46.8567 39.5049 46.8567 40.2643 46.0973C40.9652 45.3964 41.0191 44.2934 40.426 43.5306L40.2643 43.3475L31.9185 35.0002L40.2643 26.6529C40.9652 25.9519 41.0191 24.849 40.426 24.0862L40.2643 23.903Z"
                                fill="#17181C" />
                        </svg>
                    </button>
                    <button class="constructor__btn btn-prev" onClick={slideClickNext}>
                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="70" height="70" rx="35" transform="matrix(-1 0 0 1 70 0)"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M29.7357 23.903C30.4367 23.2021 31.5396 23.1482 32.3024 23.7413L32.4856 23.903L42.2078 33.6252C42.9088 34.3262 42.9627 35.4291 42.3696 36.1919L42.2078 36.3751L32.4856 46.0973C31.7263 46.8567 30.4951 46.8567 29.7357 46.0973C29.0348 45.3964 28.9809 44.2934 29.574 43.5306L29.7357 43.3475L38.0815 35.0002L29.7357 26.6529C29.0348 25.9519 28.9809 24.849 29.574 24.0862L29.7357 23.903Z"
                                fill="#17181C" />
                        </svg>
                    </button>
                </>
                }
            </div>
        </div>
        <div class="container _course">
            <Swiper ref={swiperRef} spaceBetween={30} slidesPerView={4} loop={false} class="teacher__cards">



                {showCourseTeacherData?.map((item, index) => (
                <SwiperSlide key={index} class="teacher__card teacher-card _fonBack-navy__blue">
                    <div class="teacher-card__img">
                        <img src={`http://127.0.0.1:8000/storage/${item.image}`} alt="" />
                    </div>
                    <h4 class="teacher-card__name">{item.name}</h4>
                    <p class="teacher-card__text">{item.description}</p>
                </SwiperSlide>
                ))}
            </Swiper>
        </div>

    </section>
    }


    <div class="userInfo__btns _infoUser">
        <a class="userInfo__btn _btn _notBack" href="../">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.56994 18.82C9.37994 18.82 9.18994 18.75 9.03994 18.6L2.96994 12.53C2.67994 12.24 2.67994 11.76 2.96994 11.47L9.03994 5.4C9.32994 5.11 9.80994 5.11 10.0999 5.4C10.3899 5.69 10.3899 6.17 10.0999 6.46L4.55994 12L10.0999 17.54C10.3899 17.83 10.3899 18.31 10.0999 18.6C9.95994 18.75 9.75994 18.82 9.56994 18.82Z"
                    fill="#292D32" />
                <path
                    d="M20.4999 12.75H3.66992C3.25992 12.75 2.91992 12.41 2.91992 12C2.91992 11.59 3.25992 11.25 3.66992 11.25H20.4999C20.9099 11.25 21.2499 11.59 21.2499 12C21.2499 12.41 20.9099 12.75 20.4999 12.75Z"
                    fill="#292D32" />
            </svg>

            Назад</a>
    </div>
</>
)


}
export default observer(CoursesShow);
