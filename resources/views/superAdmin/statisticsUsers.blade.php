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
        <div className="static-many static">
            <div className="static__carts">
                <div className={`static__cart cart-static ${staticSections == 'admin' && "_active"}`} onClick={() => CheckSetStaticSections('admin')}>
                    <div className="cart-static__icon">
                        <ProfileIcon name="admin" />
                    </div>
                    <div className="cart-static__info">
                        <div className="cart-static__name">Кол-во админов</div>
                        <div className="cart-static__count">350</div>
                    </div>
                </div>
                <div className={`static__cart cart-static ${staticSections == 'mentors' && "_active"}`} onClick={() => CheckSetStaticSections('mentors')}>
                    <div className="cart-static__icon">
                        <ProfileIcon name="mentors" />
                    </div>
                    <div className="cart-static__info">
                        <div className="cart-static__name">Кол-во менторов</div>
                        <div className="cart-static__count">150</div>
                    </div>
                </div>
                <div className={`static__cart cart-static ${staticSections == 'users' && "_active"}`} onClick={() => CheckSetStaticSections('users')}>
                    <div className="cart-static__icon">
                        <ProfileIcon name="users" />
                    </div>
                    <div className="cart-static__info">
                        <div className="cart-static__name">Кол-во учеников</div>
                        <div className="cart-static__count">9500</div>
                    </div>
                </div>
            </div>

            {(staticSections == "" || staticSections == 'admin') &&
                <div className="static__section">
                    <div className="static__title">Кол-во админов</div>

                    <div className="static__btns">
                        <div className="static__btn-text">Группировать по </div>
                        <div className="static__btn">дням</div>
                        <div className="static__btn">неделям</div>
                        <div className="static__btn">меясцам</div>
                        <div className="static__btn">годам</div>
                    </div>

                    <div className="static__chart">
                        <LineChart />
                    </div>
                </div>

            }

            {(staticSections == "" || staticSections == 'mentors') &&
                <div className="static__section">
                    <div className="static__title">Кол-во менторов</div>

                    <div className="static__btns">
                        <div className="static__btn-text">Группировать по </div>
                        <div className="static__btn">дням</div>
                        <div className="static__btn">неделям</div>
                        <div className="static__btn">меясцам</div>
                        <div className="static__btn">годам</div>
                    </div>

                    <div className="static__chart">
                        <LineChart />
                    </div>
                </div>
            }

            {(staticSections == "" || staticSections == 'users') &&
                <div className="static__section">
                    <div className="static__title">Кол-во учеников</div>

                    <div className="static__btns">
                        <div className="static__btn-text">Группировать по </div>
                        <div className="static__btn _active">дням</div>
                        <div className="static__btn">неделям</div>
                        <div className="static__btn">меясцам</div>
                        <div className="static__btn">годам</div>
                    </div>

                    <div className="static__chart">
                        <LineChart />
                    </div>
                </div>
            }

        </div>
    </>
}
export default observer(StatisticsUsers);