@extends('layouts.main')

@section('content')
    <section class="banner">
        <div class="banner__container container">
            <div class="banner__text">
                <h1 class='h1'>Сделай знания доступными с помощью платформы <span> Фенек</span></h1>
                <a href="{{ route('register') }}" class='banner__btn _btn _blue'>Открыть курс</a>
            </div>

            <div class="banner__left">
                <div class="banner__img">
                    <img src={{ asset('img/banner.png') }} alt="banner img" />
                    <img src={{ asset('img/banner.png') }} alt="banner img" />
                </div>
            </div>
        </div>
    </section>
    <section class="about container section" id='about'>
        <div class="about__title h2"><span>Фенек</span> - это</div>
        <div class="about__items">
            <div class="about__item item-about">
                <div class="item-about__icon">
                    <AboutIcons name="constructor" />
                </div>
                <p class="item-about__title">Конструктор</p>
                <p class='item-about__text'>Создай свой лендинг с помощью конструктора</p>
            </div>
            <div class="about__item item-about">
                <div class="item-about__icon">
                    <AboutIcons name="security-user" />

                </div>
                <p class="item-about__title">Панель администратора</p>
                <p class='item-about__text'>Всё управление в личном кабинете</p>
            </div>
            <div class="about__item item-about">
                <div class="item-about__icon">
                    <AboutIcons name="teacher" />
                </div>
                <p class="item-about__title">Личный кабинет учеников</p>
                <p class='item-about__text'>Для ваших клиентов есть доступ к материалам</p>
            </div>
            <div class="about__item item-about">
                <div class="item-about__icon">
                    <AboutIcons name="mentor" />
                </div>
                <p class="item-about__title">Менторы</p>
                <p class='item-about__text'>Нанимайте менторов для поддержки учеников</p>
            </div>
        </div>
    </section>

    <section class="projects container section" id='projects'>
        <div class="projects__title h2">Наша <span>платформа</span> <br />подойдёт</div>

        <div class="projects__items">
            <div class="projects__item item-projects">
                <div class="item-projects__img">
                    <img src={logo} alt="" />
                </div>
                <div class="item-projects__title">Компании</div>
                <p class="item-projects__text">Корпоративное обучение сотрудников. Создавайте онлайн-курсы и
                    обучающие модули внутри вашей компании. Удобная аналитика, отслеживание прогресса и
                    сертификация.</p>
                <a href="#" class='item-projects__btn _btn _blue-text'>Узнать тариф</a>
            </div>
            <div class="projects__item item-projects">
                <div class="item-projects__img">
                    <img src={logo} alt="" />
                </div>
                <div class="item-projects__title">Блогеры</div>
                <p class="item-projects__text">Прокачали свою экспертизу и готовы заработать на своих знаниях?
                    Запускайте свою школу у нас!</p>
                <a href="#" class='item-projects__btn _btn _blue-text'>Узнать тариф</a>
            </div>

            <div class="projects__item item-projects">
                <div class="item-projects__img">
                    <img src={logo} alt="" />
                </div>
                <div class="item-projects__title">Эксперты и коучи</div>
                <p class="item-projects__text">
                    Монетизируйте свои знания. Создавайте обучающие программы, продвигайте личный бренд и
                    привлекайте учеников. Никаких технических сложностей — только вы и ваши знания.
                </p>
                <a href="#" class='item-projects__btn  _btn _blue-text'>Узнать тариф</a>
            </div>
            <div class="projects__item item-projects">
                <div class="item-projects__img">
                    <img src={logo} alt="" />
                </div>
                <div class="item-projects__title">Онлайн-школы и стартапы</div>
                <p class="item-projects__text">
                    Быстрый запуск образовательного продукта. Идеально подходит для запуска собственной
                    онлайн-школы: всё от сайта до платформы для обучения уже готово.
                </p>
                <a href="#" class='item-projects__btn  _btn _blue-text'>Узнать тариф</a>
            </div>
        </div>
    </section>

    <section class='black-fon'>
        <div class="container">
            <section class='black-fon__logo'>
                <div class='black-fon__logo-img'>
                    <img src={logo} alt="" />
                </div>
            </section>


            <section class='constructor' id='constructor'>
                <div class="constructor__title h2">Создай свой лендинг на простом <span>конструкторе</span>
                </div>
                <Swiper ref={swiperRef} spaceBetween={slidesPerBetween} slidesPerView={slidesPerView} loop={false}
                    class="constructor__items">
                    <SwiperSlide class="constructor__item item-constructor">
                        <div class="item-constructor__img">
                            <img src={sliderContr} alt="" />
                        </div>
                        <div class="item-constructor__number">01</div>
                        <p class="item-constructor__title">Выбор шаблона</p>
                    </SwiperSlide>
                    <SwiperSlide class="constructor__item item-constructor">
                        <div class="item-constructor__img">
                            <img src={sliderContr} alt="" />
                        </div>
                        <div class="item-constructor__number">02</div>
                        <p class="item-constructor__title">Выбор шаблона</p>
                    </SwiperSlide>
                    <SwiperSlide class="constructor__item item-constructor">
                        <div class="item-constructor__img">
                            <img src={sliderContr} alt="" />
                        </div>
                        <div class="item-constructor__number">03</div>
                        <p class="item-constructor__title">Выбор шаблона</p>
                    </SwiperSlide>
                    <SwiperSlide class="constructor__item item-constructor">
                        <div class="item-constructor__img">
                            <img src={sliderContr} alt="" />
                        </div>
                        <div class="item-constructor__number">04</div>
                        <p class="item-constructor__title">Выбор шаблона</p>
                    </SwiperSlide>
                </Swiper>

                <div class="constructor__btns">
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
                </div>
            </section>

            <section class="system section" id='system'>
                <div class="system__title h2">Удобная система <br /> управления <span>курсами</span></div>

                <div class="system__info">

                    <div class="system__items">
                        {{-- {systemItems.map((item, index) => (
                            <div key={index} class={`system__item item-system ${activeIndex===index ? '_active' : ''
                                }`} onClick={()=> setActiveIndex(index)}
                                >
                                <div class='item-system__icon'>

                                    {index == 0 ?
                                    <AboutIcons name="security-user" /> : ""}
                                    {index == 1 ?
                                    <AboutIcons name="teacher" /> : ""}
                                    {index == 2 ?
                                    <AboutIcons name="mentor" /> : ""}
                                </div>

                                <div class="item-system__title">{item.title}</div>
                                <p class="item-system__text">{item.text}</p>
                            </div>
                            ))} --}}
                    </div>

                    <div class="item-system _info">
                        <div class="item-system__title">{systemItems[activeIndex].title}</div>
                        <p class="item-system__text">{systemItems[activeIndex].text}</p>
                    </div>

                    <div class="system__media">

                        {{-- {activeIndex === 0 &&
                            <div class="system__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            }
                            {activeIndex === 1 &&
                            <div class="system__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            }
                            {activeIndex === 2 &&
                            <LazyVideoPlayer />
                            } --}}
                    </div>
                </div>
            </section>

            <section class='rate section' id='rate'>
                <div class="rate__title h2">Тарифы</div>

                <div class="rate__items">
                    <div class="rate__item item-rate">
                        <div class="item-rate__name">Курс</div>
                        <div class="item-rate__list">
                            <div class="item-rate__list-item">
                                <p>Кол-во курсов</p>
                                <p>1 курс</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Нанимать ментора</p>
                                <p>0</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Кол-во уроков</p>
                                <p>15 уроков</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Статистика</p>
                                <p>нет</p>
                            </div>
                        </div>
                        <a href="#" class="item-rate__btn _btn _blue">Выбрать</a>
                    </div>
                    <div class="rate__item item-rate">
                        <div class="item-rate__name">Школа</div>
                        <div class="item-rate__list">
                            <div class="item-rate__list-item">
                                <p>Кол-во курсов</p>
                                <p>до 5 курсов</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Нанимать ментора</p>
                                <p>1 на курс</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Кол-во уроков</p>
                                <p>50 уроков</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Статистика</p>
                                <p>есть</p>
                            </div>
                        </div>
                        <a href="#" class="item-rate__btn _btn _blue">Выбрать</a>
                    </div>
                    <div class="rate__item item-rate">
                        <div class="item-rate__name">Академия</div>
                        <div class="item-rate__list">
                            <div class="item-rate__list-item">
                                <p>Кол-во курсов</p>
                                <p>до 3 на курс</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Нанимать ментора</p>
                                <p>до 3 на курс</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Кол-во уроков</p>
                                <p>200 уроков</p>
                            </div>
                            <div class="item-rate__list-item">
                                <p>Статистика</p>
                                <p>есть</p>
                            </div>
                        </div>
                        <a href="#" class="item-rate__btn _btn _blue">Выбрать</a>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <section class='white-fon'>
        <div class="feedback">
            <div class="feedback__text">
                <p class="feedback__title h2">Есть вопросы?</p>
                <p class="feedback__subtitle">
                    Оставьте заявку и наш менеджер свяжется с вами в ближайшее время
                </p>
            </div>
            <form class="feedback__form" onSubmit={handleSubmit(sendMessage)}>
                <DivInput class={'feedback__input'} label='Ваше имя'>
                    <input type="text" placeholder="Имя" name="" id="" />
                </DivInput>

                <DivInput class={'feedback__input'} label='Номер телефона '>
                    <input type="text" placeholder="Имя" name="" id="" />
                </DivInput>
                <button class='feedback__btn _btn _blue'>Отправить</button>
                <p class='feedback__discreption'>Нажимая кнопку, принимаю
                    <a href="#">условия политики</a> и
                    <a href="#">пользовательского соглашения</a>
                </p>
            </form>
        </div>


        <section class='faq section container'>
            <div class="faq__title h2">Быстрые <span>ответы</span></div>
            <div class="faq__items">
                {{-- {faqQuestions.map((item, index) => (
                    <FAQItem key={index} name={item.name} text={item.text} />
                    ))} --}}
            </div>
        </section>
    </section>
@endsection
