<div class="profile">
    @include('components.header__profile')
    <div class="profile__main">
        <div class="profile__panel panel-profile">
            <div class="panel-profile__items">
                <a href="{item.link}" class="panel-profile__item item-profile">
                    <div class="item-profile__icon">
                        <ProfileIcon name={item.icon} />
                    </div>
                    <p class="item-profile__name">{item.name}</p>
                </a>
                <div class="panel-profile__item item-profile" onClick={signout}>
                    <div class="item-profile__icon">
                        <ProfileIcon name="logout" />
                    </div>
                    <p class="item-profile__name">Выйти</p>
                </div>
            </div>
        </div>
        <div class="profile__window window-profile">
            <div class="window-profile__title h4">Мой профиль</div>
            <div class="window-profile__bady">
                @yield('window')
            </div>
        </div>
    </div>
</div>
@include('components.footer')
