import { observer } from "mobx-react-lite";
import { Link } from "react-router-dom";
import DivInput from "../../../core/UIKit/input";
import Icon from "../../../core/UIKit/icons";
import { useEffect, useState } from "react";

import foto from "../../../assets/img/banner.png";
import courseModal from "./models/course-modal";
import { useAuth } from "../../../core/hoc/AuthProvider";
import { courseCatalog } from "./service/course-service";
import Example from "./components/LottieAnimation";
import loadableModel from "../../../core/UIKit/loadable/Loadable";
import DeleteModal from "../../../core/UIKit/DeleteModal";

function Courses() {

const { getCourseAllData, courseCatalogList, setCourseCatalogList, setCourseDelete, deleteCourseId } = courseModal
const { isLoading, setLoadable } = loadableModel

useEffect(() => {
courseCatalog()
.then(res => {
setCourseCatalogList(res.data.courses);
})
.catch(err => {
console.log(err)
})
.finally(() => {
setLoadable(false)
})
}, [])

const [staticSections, setStaticSections] = useState("");

const CheckSetStaticSections = (name) => {
setStaticSections(staticSections === name ? "" : name)
}


const handleOverlayClick = (e) => {
if (e.target === e.currentTarget) {
closeModal();
}
};


return isLoading ?
<Example /> :
<>
    <div class="courses">
        <div class="courses__header">
            <DivInput class="courses__search search">
                <input type="text" placeholder="Название училища" />
                {/* <input type="text" onChange={e=> setSearch(e.target.value)} value={search}
                placeholder="Название училища" /> */}

                <div class="search__icon">
                    <Icon name={"search"} />
                </div>
            </DivInput>

            <a class="courses__add" href={"/admin/courses/form"}>
                <Icon class="courses__add__icon" name={"plus"} />
                <span>Добавить</span>
            </a>
        </div>

        <div class="courses__items">
            {
            courseCatalogList.length > 0 &&
            courseCatalogList.map((item, index) => (
            <div class="courses__item item-course" key={index}>
                <div>
                    <div class="item-course__img">
                        <img src={`http://127.0.0.1:8000/storage/${item.image}`} alt="" />
                    </div>
                    <h5 class="item-course__name">{item.name}</h5>
                    <p class="item-course__text">{item.mini_description}</p>
                </div>
                <div class="item-course__btns">
                    <a class="item-course__bnt _btn _blue" href={"/admin/courses/edit/" + item.id}>Редактировать</a>
                    <DeleteModal classBtn={"item-course__bnt _btn _red"} idInfo={item.id} btnOnClick={deleteCourseId}
                        onConfirm={setCourseDelete} onCancel={()=> console.log('Удаление отменено')}
                        itemName="курс 'Введение в React'"
                        />
                </div>
                <a class="item-course__link _btn" href={"/admin/courses/show/" + item.id}>Подробнее</a>
            </div>
            ))}
        </div>
    </div>
</>
}
export default observer(Courses);
