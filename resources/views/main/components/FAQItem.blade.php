<div className="faq__item item-faq">
    <div className="item-faq__top">
        <p className="item-faq__title">{name}</p>
        <button className="item-faq__btn" onClick={toggleOpen}>
            <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.33254 0.701329C8.63254 0.701329 7.93254 0.971328 7.40254 1.50133L0.882539 8.02133C0.592539 8.31133 0.592539 8.79133 0.882539 9.08133C1.17254 9.37133 1.65254 9.37133 1.94254 9.08133L8.46254 2.56133C8.94254 2.08133 9.72254 2.08133 10.2025 2.56133L16.7225 9.08133C17.0125 9.37133 17.4925 9.37133 17.7825 9.08133C18.0725 8.79133 18.0725 8.31133 17.7825 8.02133L11.2625 1.50133C10.7325 0.971328 10.0325 0.701329 9.33254 0.701329Z"
                    fill="#292D32" />
            </svg>
        </button>
    </div>

    <p className="item-faq__text">{text}</p>
</div>
