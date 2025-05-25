<div className="profile">
    @include('components.header__profile')
    <div className="profile__main">
        <div className="profile__panel panel-profile">
            <div className="panel-profile__items">
                <a href="{item.link}" className="panel-profile__item item-profile">
                    <div className="item-profile__icon">
                        <ProfileIcon name={item.icon} />
                    </div>
                    <p className="item-profile__name">{item.name}</p>
                </a>
                <div className="panel-profile__item item-profile" onClick={signout}>
                    <div className="item-profile__icon">
                        <ProfileIcon name="logout" />
                    </div>
                    <p className="item-profile__name">Выйти</p>
                </div>
            </div>
        </div>
        <div className="profile__window window-profile">
            <div className="window-profile__title h4">Мой профиль</div>
            <div className="window-profile__bady">
                @yield('window')
            </div>
        </div>
    </div>
</div>
@include('components.footer')
