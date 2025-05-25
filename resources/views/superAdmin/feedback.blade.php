import { observer } from "mobx-react-lite";
import { Link } from "react-router-dom";
import { useState } from "react";
import ProfileIcon from "../../layout/profileComponents/profileIcons";

function Feedback() {

    const [foreachFor, setForeachFor] = useState(['asd', 1, 2, 3, 4, 5]);
    return <>
        <div className="list-feedback list-column">
            <div className="list-feedback__count">Общее количество заявок</div>
            {foreachFor.map((item, index) => {
                return <div key={index} className="list-feedback__item item-feedback list-column__item">
                    <div className="item-feedback__left">
                        <p className="item-feedback__name">Классное название компании</p>
                        <a href="tel:" className="item-feedback__tel">Классное название компании</a>
                    </div>
                    <div className="item-feedback__right">
                        <div className="item-feedback__btn _btn _red">
                            <ProfileIcon name="delete" />
                        </div>
                    </div>
                </div>
            })}
        </div>
    </>
}
export default observer(Feedback);