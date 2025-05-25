import { observer } from "mobx-react-lite";
import { Link } from "react-router-dom";
import DivInput from "../../../core/UIKit/input";
import Icon from "../../../core/UIKit/icons";
import ProfileIcon from "../../layout/profileComponents/profileIcons";
import LineChart from "./components/statistic";
import { useEffect, useState } from "react";
function StatisticsMany() {


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
                    <div class="cart-static__name">Доход от админов</div>
                    <div class="cart-static__count">5000 ₽</div>
                </div>
            </div>
            <div class={`static__cart cart-static ${staticSections=='users' && "_active" }`} onClick={()=>
                CheckSetStaticSections('users')}>
                <div class="cart-static__icon">
                    <ProfileIcon name="users" />
                </div>
                <div class="cart-static__info">
                    <div class="cart-static__name">Доход от учеников</div>
                    <div class="cart-static__count">5000 ₽</div>
                </div>
            </div>
        </div>

        {(staticSections == "" || staticSections == 'admin') &&
        <div class="static__section">
            <div class="static__title">Доход от админов</div>

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
            <div class="static__title">Доход от учеников</div>

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
export default observer(StatisticsMany);
