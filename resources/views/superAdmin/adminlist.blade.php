import { observer } from "mobx-react-lite";
import LineChart from "./components/statistic";
import { Link } from "react-router-dom";
import { useState } from "react";
import DivInput from "../../../core/UIKit/input";
import listAdminModel from "./models/login-model";
import Icon from "../../../core/UIKit/icons";
function ListAdmin() {

const [foreachFor, setForeachFor] = useState(['asd', 1, 2, 3, 4, 5]);
const { search, setSearch, searchInfo } = listAdminModel;
return <>
    <div class="listadmin list-column">
        <DivInput class="listadmin__search search">
            <input type="text" onChange={e=> setSearch(e.target.value)} value={search} placeholder="Название училища"
            />

            <div onClick={searchInfo} class="search__icon">
                <Icon name={"search"} />
            </div>
        </DivInput>

        {foreachFor.map((item, index) => {

        return <div key={index} class="listadmin__item list-column__item">
            <div class="listadmin__item-top">Фамилия и имя</div>
            <div class="listadmin__item-bottom">
                <p class="listadmin__item-company">Классное название компании</p>
                <a href={''} class="listadmin__item-site">
                    <p>
                        Перейти на сайт
                    </p>
                    <div class="listadmin__item-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.5 22.75H20.5C20.91 22.75 21.25 22.41 21.25 22C21.25 21.59 20.91 21.25 20.5 21.25H3.5C3.09 21.25 2.75 21.59 2.75 22C2.75 22.41 3.09 22.75 3.5 22.75Z"
                                fill="#17181C" />
                            <path
                                d="M5.00055 18.2499C5.19055 18.2499 5.38055 18.1799 5.53055 18.0299L19.5305 4.02994C19.8205 3.73994 19.8205 3.25994 19.5305 2.96994C19.2405 2.67994 18.7605 2.67994 18.4705 2.96994L4.47055 16.9699C4.18055 17.2599 4.18055 17.7399 4.47055 18.0299C4.62055 18.1799 4.81055 18.2499 5.00055 18.2499Z"
                                fill="#17181C" />
                            <path
                                d="M19 14.52C19.41 14.52 19.75 14.18 19.75 13.77V3.5C19.75 3.09 19.41 2.75 19 2.75H8.73C8.32 2.75 7.98 3.09 7.98 3.5C7.98 3.91 8.32 4.25 8.73 4.25H18.25V13.77C18.25 14.18 18.59 14.52 19 14.52Z"
                                fill="#17181C" />
                        </svg>
                    </div>
                    </Link>
            </div>
        </div>
        })}
    </div>
</>
}
export default observer(ListAdmin);
