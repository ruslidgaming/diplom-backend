        <section className="banner">
            <div className="banner__container container">
                <div className="banner__text">
                    <h1 className='h1'>Сделай знания доступными с помощью платформы <span> Фенек</span></h1>
                    <Link to="" className='banner__btn _btn _blue'>Открыть курс</Link>
                </div>
                <div className="banner__left">
                    <div className="banner__img">
                        <img src={banner} alt="banner img" />
                        <img src={banner} alt="banner img" />
                    </div>
                </div>
            </div>
        </section>
        <section className="about container section" id='about'>
            <div className="about__title h2"><span>Фенек</span> - это</div>
            <div className="about__items">
                <div className="about__item item-about">
                    <div className="item-about__icon">
                        <AboutIcons name="constructor" />
                    </div>
                    <p className="item-about__title">Конструктор</p>
                    <p className='item-about__text'>Создай свой лендинг с помощью конструктора</p>
                </div>
                <div className="about__item item-about">
                    <div className="item-about__icon">
                        <AboutIcons name="security-user" />

                    </div>
                    <p className="item-about__title">Панель администратора</p>
                    <p className='item-about__text'>Всё управление в личном кабинете</p>
                </div>
                <div className="about__item item-about">
                    <div className="item-about__icon">
                        <AboutIcons name="teacher" />
                    </div>
                    <p className="item-about__title">Личный кабинет учеников</p>
                    <p className='item-about__text'>Для ваших клиентов есть доступ к материалам</p>
                </div>
                <div className="about__item item-about">
                    <div className="item-about__icon">
                        <AboutIcons name="mentor" />
                    </div>
                    <p className="item-about__title">Менторы</p>
                    <p className='item-about__text'>Нанимайте менторов для поддержки учеников</p>
                </div>
            </div>
        </section>

        <section className="projects container section" id='projects'>
            <div className="projects__title h2">Наша <span>платформа</span> <br />подойдёт</div>

            <div className="projects__items">
                <div className="projects__item item-projects">
                    <div className="item-projects__img">
                        <img src={logo} alt="" />
                    </div>
                    <div className="item-projects__title">Компании</div>
                    <p className="item-projects__text">Корпоративное обучение сотрудников. Создавайте онлайн-курсы и
                        обучающие модули внутри вашей компании. Удобная аналитика, отслеживание прогресса и
                        сертификация.</p>
                    <Link to="#" className='item-projects__btn _btn _blue-text'>Узнать тариф</Link>
                </div>
                <div className="projects__item item-projects">
                    <div className="item-projects__img">
                        <img src={logo} alt="" />
                    </div>
                    <div className="item-projects__title">Блогеры</div>
                    <p className="item-projects__text">Прокачали свою экспертизу и готовы заработать на своих знаниях?
                        Запускайте свою школу у нас!</p>
                    <Link to="#" className='item-projects__btn _btn _blue-text'>Узнать тариф</Link>
                </div>

                <div className="projects__item item-projects">
                    <div className="item-projects__img">
                        <img src={logo} alt="" />
                    </div>
                    <div className="item-projects__title">Эксперты и коучи</div>
                    <p className="item-projects__text">
                        Монетизируйте свои знания. Создавайте обучающие программы, продвигайте личный бренд и
                        привлекайте учеников. Никаких технических сложностей — только вы и ваши знания.
                    </p>
                    <Link to="#" className='item-projects__btn  _btn _blue-text'>Узнать тариф</Link>
                </div>
                <div className="projects__item item-projects">
                    <div className="item-projects__img">
                        <img src={logo} alt="" />
                    </div>
                    <div className="item-projects__title">Онлайн-школы и стартапы</div>
                    <p className="item-projects__text">
                        Быстрый запуск образовательного продукта. Идеально подходит для запуска собственной
                        онлайн-школы: всё от сайта до платформы для обучения уже готово.
                    </p>
                    <Link to="#" className='item-projects__btn  _btn _blue-text'>Узнать тариф</Link>
                </div>
            </div>
        </section>

        <section className='black-fon'>
            <div className="container">
                <section className='black-fon__logo'>
                    <div className='black-fon__logo-img'>
                        <img src={logo} alt="" />
                    </div>
                </section>


                <section className='constructor' id='constructor'>
                    <div className="constructor__title h2">Создай свой лендинг на простом <span>конструкторе</span>
                    </div>
                    <Swiper ref={swiperRef} spaceBetween={slidesPerBetween} slidesPerView={slidesPerView} loop={false}
                        className="constructor__items">
                        <SwiperSlide className="constructor__item item-constructor">
                            <div className="item-constructor__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            <div className="item-constructor__number">01</div>
                            <p className="item-constructor__title">Выбор шаблона</p>
                        </SwiperSlide>
                        <SwiperSlide className="constructor__item item-constructor">
                            <div className="item-constructor__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            <div className="item-constructor__number">02</div>
                            <p className="item-constructor__title">Выбор шаблона</p>
                        </SwiperSlide>
                        <SwiperSlide className="constructor__item item-constructor">
                            <div className="item-constructor__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            <div className="item-constructor__number">03</div>
                            <p className="item-constructor__title">Выбор шаблона</p>
                        </SwiperSlide>
                        <SwiperSlide className="constructor__item item-constructor">
                            <div className="item-constructor__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            <div className="item-constructor__number">04</div>
                            <p className="item-constructor__title">Выбор шаблона</p>
                        </SwiperSlide>
                    </Swiper>

                    <div className="constructor__btns">
                        <button className="constructor__btn btn-prev" onClick={slideClickPrev}>
                            <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect width="70" height="70" rx="35" fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M40.2643 23.903C39.5633 23.2021 38.4604 23.1482 37.6976 23.7413L37.5144 23.903L27.7922 33.6252C27.0912 34.3262 27.0373 35.4291 27.6304 36.1919L27.7922 36.3751L37.5144 46.0973C38.2737 46.8567 39.5049 46.8567 40.2643 46.0973C40.9652 45.3964 41.0191 44.2934 40.426 43.5306L40.2643 43.3475L31.9185 35.0002L40.2643 26.6529C40.9652 25.9519 41.0191 24.849 40.426 24.0862L40.2643 23.903Z"
                                    fill="#17181C" />
                            </svg>
                        </button>
                        <button className="constructor__btn btn-prev" onClick={slideClickNext}>
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

                <section className="system section" id='system'>
                    <div className="system__title h2">Удобная система <br /> управления <span>курсами</span></div>

                    <div className="system__info">

                        <div className="system__items">
                            {{-- {systemItems.map((item, index) => (
                            <div key={index} className={`system__item item-system ${activeIndex===index ? '_active' : ''
                                }`} onClick={()=> setActiveIndex(index)}
                                >
                                <div className='item-system__icon'>

                                    {index == 0 ?
                                    <AboutIcons name="security-user" /> : ""}
                                    {index == 1 ?
                                    <AboutIcons name="teacher" /> : ""}
                                    {index == 2 ?
                                    <AboutIcons name="mentor" /> : ""}
                                </div>

                                <div className="item-system__title">{item.title}</div>
                                <p className="item-system__text">{item.text}</p>
                            </div>
                            ))} --}}
                        </div>

                        <div className="item-system _info">
                            <div className="item-system__title">{systemItems[activeIndex].title}</div>
                            <p className="item-system__text">{systemItems[activeIndex].text}</p>
                        </div>

                        <div className="system__media">

                            {{-- {activeIndex === 0 &&
                            <div className="system__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            }
                            {activeIndex === 1 &&
                            <div className="system__img">
                                <img src={sliderContr} alt="" />
                            </div>
                            }
                            {activeIndex === 2 &&
                            <LazyVideoPlayer />
                            } --}}
                        </div>
                    </div>
                </section>

                <section className='rate section' id='rate'>
                    <div className="rate__title h2">Тарифы</div>

                    <div className="rate__items">
                        <div className="rate__item item-rate">
                            <div className="item-rate__name">Курс</div>
                            <div className="item-rate__list">
                                <div className="item-rate__list-item">
                                    <p>Кол-во курсов</p>
                                    <p>1 курс</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Нанимать ментора</p>
                                    <p>0</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Кол-во уроков</p>
                                    <p>15 уроков</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Статистика</p>
                                    <p>нет</p>
                                </div>
                            </div>
                            <Link to="#" className="item-rate__btn _btn _blue">Выбрать</Link>
                        </div>
                        <div className="rate__item item-rate">
                            <div className="item-rate__name">Школа</div>
                            <div className="item-rate__list">
                                <div className="item-rate__list-item">
                                    <p>Кол-во курсов</p>
                                    <p>до 5 курсов</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Нанимать ментора</p>
                                    <p>1 на курс</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Кол-во уроков</p>
                                    <p>50 уроков</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Статистика</p>
                                    <p>есть</p>
                                </div>
                            </div>
                            <Link to="#" className="item-rate__btn _btn _blue">Выбрать</Link>
                        </div>
                        <div className="rate__item item-rate">
                            <div className="item-rate__name">Академия</div>
                            <div className="item-rate__list">
                                <div className="item-rate__list-item">
                                    <p>Кол-во курсов</p>
                                    <p>до 3 на курс</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Нанимать ментора</p>
                                    <p>до 3 на курс</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Кол-во уроков</p>
                                    <p>200 уроков</p>
                                </div>
                                <div className="item-rate__list-item">
                                    <p>Статистика</p>
                                    <p>есть</p>
                                </div>
                            </div>
                            <Link to="#" className="item-rate__btn _btn _blue">Выбрать</Link>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section className='white-fon'>
            <div className="feedback">
                <div className="feedback__text">
                    <p className="feedback__title h2">Есть вопросы?</p>
                    <p className="feedback__subtitle">
                        Оставьте заявку и наш менеджер свяжется с вами в ближайшее время
                    </p>
                </div>
                <form className="feedback__form" onSubmit={handleSubmit(sendMessage)}>
                    <DivInput className={'feedback__input'} label='Ваше имя'>
                        <input type="text" placeholder="Имя" name="" id="" />
                    </DivInput>

                    <DivInput className={'feedback__input'} label='Номер телефона '>
                        <input type="text" placeholder="Имя" name="" id="" />
                    </DivInput>
                    <button className='feedback__btn _btn _blue'>Отправить</button>
                    <p className='feedback__discreption'>Нажимая кнопку, принимаю
                        <Link to="#">условия политики</Link> и
                        <Link to="#">пользовательского соглашения</Link>
                    </p>
                </form>
            </div>


            <section className='faq section container'>
                <div className="faq__title h2">Быстрые <span>ответы</span></div>
                <div className="faq__items">
                    {{-- {faqQuestions.map((item, index) => (
                    <FAQItem key={index} name={item.name} text={item.text} />
                    ))} --}}
                </div>
            </section>
        </section>
