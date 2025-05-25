import { observer } from "mobx-react-lite";
import { Link } from "react-router-dom";
import DivInput from "../../../core/UIKit/input";
import Icon from "../../../core/UIKit/icons";
import ProfileIcon from "../../layout/profileComponents/profileIcons";
import LineChart from "./components/statistic";
import { useState } from "react";
function StatisticsUsers() {

const [staticSections, setStaticSections] = useState("");

const CheckSetStaticSections = (name) => {
setStaticSections(staticSections === name ? "" : name)
}

return <>
    <div class="static-many static">
        <div class="static__carts">
            <div class={`static__cart cart-static ${staticSections=='admin' && "_active" }`} onClick={()=>
                CheckSetStaticSections('admin')}>
                <div class="cart-static__icon">
                    <ProfileIcon name="admin" />
                </div>
                <div class="cart-static__info">
                    <div class="cart-static__name">Кол-во админов</div>
                    <div class="cart-static__count">350</div>
                </div>
            </div>
            <div class={`static__cart cart-static ${staticSections=='mentors' && "_active" }`} onClick={()=>
                CheckSetStaticSections('mentors')}>
                <div class="cart-static__icon">
                    <ProfileIcon name="mentors" />
                </div>
                <div class="cart-static__info">
                    <div class="cart-static__name">Кол-во менторов</div>
                    <div class="cart-static__count">150</div>
                </div>
            </div>
            <div class={`static__cart cart-static ${staticSections=='users' && "_active" }`} onClick={()=>
                CheckSetStaticSections('users')}>
                <div class="cart-static__icon">
                    <ProfileIcon name="users" />
                </div>
                <div class="cart-static__info">
                    <div class="cart-static__name">Кол-во учеников</div>
                    <div class="cart-static__count">9500</div>
                </div>
            </div>
        </div>

        {(staticSections == "" || staticSections == 'admin') &&
        <div class="static__section">
            <div class="static__title">Кол-во админов</div>

            <div class="static__btns">
                <div class="static__btn-text">Группировать по </div>
                <div class="static__btn">дням</div>
                <div class="static__btn">неделям</div>
                <div class="static__btn">меясцам</div>
                <div class="static__btn">годам</div>
            </div>

            <div class="static__chart">
                <LineChart />
            </div>
        </div>

        }

        {(staticSections == "" || staticSections == 'mentors') &&
        <div class="static__section">
            <div class="static__title">Кол-во менторов</div>

            <div class="static__btns">
                <div class="static__btn-text">Группировать по </div>
                <div class="static__btn">дням</div>
                <div class="static__btn">неделям</div>
                <div class="static__btn">меясцам</div>
                <div class="static__btn">годам</div>
            </div>

            <div class="static__chart">
                <LineChart />
            </div>
        </div>
        }

        {(staticSections == "" || staticSections == 'users') &&
        <div class="static__section">
            <div class="static__title">Кол-во учеников</div>

            <div class="static__btns">
                <div class="static__btn-text">Группировать по </div>
                <div class="static__btn _active">дням</div>
                <div class="static__btn">неделям</div>
                <div class="static__btn">меясцам</div>
                <div class="static__btn">годам</div>
            </div>

            <div class="static__chart">
                <LineChart />
            </div>
        </div>
        }

    </div>
</>
}
export default observer(StatisticsUsers);
