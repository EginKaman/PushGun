<template>
    <main>
        <div class="create-push-mail">
            <div class="create-push-mail__btn">
                <a :class="{ active: show === 1 }"
                    >1<span>.Информация о рассылке</span></a
                >
                <a :class="{ active: show === 2 }"
                    >2<span>.Контент письма</span></a
                >
                <a :class="{ active: show === 3 }"
                    >3<span>.Предпросмотр и отправка</span></a
                >
            </div>
            <form v-if="show === 1">
                <div class="create-push-mail__title">
                    <h2>Новая e-mail рассылка</h2>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__block__item">
                        <p>Адресная книга</p>
                        <select v-model="form.address_book_id">
                            <option
                                v-for="addressbook in addressbooks"
                                :key="addressbook.id"
                                :value="addressbook.id"
                            >
                                {{ addressbook.name }}
                            </option>
                        </select>
                    </div>
                    <div class="create-push-mail__block__item">
                        <p>Адрес отправителя</p>
                        <select
                            @change="
                                adressCurrent(
                                    (selectedIndex = [
                                        $event.target.selectedIndex,
                                        2
                                    ])
                                )
                            "
                            v-model="item.adressSend.title"
                        >
                            <option style="display: none" disabled selected
                                >Значение</option
                            >
                            <option>Адрес отправителя 1</option>
                            <option>Адрес отправителя 2</option>
                            <option>Адрес отправителя 3</option>
                        </select>
                    </div>
                    <div class="create-push-mail__block__item">
                        <p>Имя отправителя</p>
                        <input
                            v-model="form.sender_name"
                            type="text"
                            placeholder="Значение"
                        />
                    </div>
                    <div class="create-push-mail__block__item">
                        <p>Тема сообщения</p>
                        <input
                            v-model="form.subject"
                            type="text"
                            placeholder="Значение"
                        />
                    </div>
                </div>
                <button @click.prevent="step((stepCurrent = 1))">Далее</button>
            </form>
            <form v-if="show === 2">
                <div class="create-push-mail__title">
                    <h2>Контент письма</h2>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__content">
                        <div @click="imgModal = true" class="image__wrapper">
                            <img
                                class="image-before"
                                src="../../images/search.svg"
                                alt=""
                            />
                            <img :src="src" />
                        </div>
                        <div>
                            <div
                                style="margin-bottom: 0"
                                class="create-push-mail__block__item"
                            >
                                <p>Прехедер письма</p>
                                <input
                                    v-model="form.preheader"
                                    type="text"
                                    placeholder="Значение"
                                />
                            </div>
                            <button>Редактировать шаблон</button>
                            <div class="create-push-mail__block__item label">
                                <p>
                                    Прикрепить файл
                                    <img src="../../images/link.svg" alt="" />
                                </p>
                                <label>
                                    <input type="file" @change="selectImage" />
                                    <span
                                        >Перетащите файл сюда или кликните,
                                        чтобы загрузить их</span
                                    >
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button @click.prevent="step((stepCurrent = 2))">Далее</button>
            </form>
            <form v-if="show === 3">
                <div class="create-push-mail__title">
                    <h2>Информация о рассылке</h2>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__block__item wrapp">
                        <p>Адресная книга:</p>
                        <span>{{
                            selectedAddressBook ? selectedAddressBook.name : ""
                        }}</span>
                    </div>
                    <div class="create-push-mail__block__item wrapp">
                        <p>Отправитель:</p>
                        <span>{{ form.sender_name }}</span>
                    </div>
                    <div class="create-push-mail__block__item wrapp">
                        <p>Тема сообщения:</p>
                        <span>{{ form.subject }}</span>
                    </div>
                </div>
                <div class="create-push-mail__title">
                    <h2>Контент письма</h2>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__content">
                        <div @click="imgModal = true" class="image__wrapper">
                            <img
                                class="image-before"
                                src="../../images/search.svg"
                                alt=""
                            />
                            <img :src="src" />
                        </div>
                        <div>
                            <div
                                style="margin-bottom: 0"
                                class="create-push-mail__block__item"
                            >
                                <p>{{ form.preheader }}</p>
                            </div>
                            <div class="create-push-mail__block__item">
                                <a style="font-weight: 400; cursor: pointer"
                                    >Отказаться от рассылки</a
                                >
                            </div>
                            <div class="create-push-mail__block__item">
                                <div class="create-push-mail__block__item info">
                                    <span></span>
                                    <p>
                                        В шаблоне отсутствует ссылка на страницу
                                        отписки. Вставьте ее используя шорткод:
                                        <br />
                                        {{ unsubscribe }} или она будет доавлена
                                        автоматически
                                    </p>
                                </div>
                            </div>
                            <button>Тестовая рассылка</button>
                        </div>
                    </div>
                </div>
                <div class="create-push-mail__block__item info inform">
                    <span></span>
                    <p>
                        В шаблоне отсутствует ссылка на страницу отписки.
                        Вставьте ее используя шорткод: <br />
                        {{ unsubscribe }} или она будет доавлена автоматически
                    </p>
                </div>
                <div class="create-push-mail__title">
                    <h2>Отправка рассылки</h2>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__block__item radiobox">
                        <p>Время отправки:</p>
                        <label>
                            <input
                                name="send"
                                :value="1"
                                v-model="modeSend"
                                type="radio"
                            />
                            <p>Немедленно</p>
                        </label>
                        <div class="cal">
                            <label>
                                <input
                                    name="send"
                                    :value="2"
                                    v-model="modeSend"
                                    type="radio"
                                />
                                <p style="margin-right: 20px">
                                    Начать отправку
                                </p>
                            </label>
                            <calendar
                                v-if="modeSend === 2"
                                calendarType="simple"
                                placeholder="Выберите дату"
                                :key="modeSend"
                                @selectedDate="
                                    date => {
                                        form.date_send = new Date(
                                            date
                                        ).toLocaleString();
                                    }
                                "
                            ></calendar>
                        </div>
                    </div>
                    <div class="create-push-mail__block__item checkbox">
                        <label>
                            <input name="send" type="checkbox" />
                            <p>Переотправить рассылку по непрочитанным</p>
                        </label>
                    </div>
                </div>
                <button
                    v-if="show != 3"
                    @click.prevent="step((stepCurrent = 3))"
                >
                    Далее
                </button>
                <button v-if="show === 3" @click.prevent="createEmailMailing">
                    Начать рассылку
                </button>
            </form>
        </div>
        <div
            v-if="imgModal === true"
            @click.self="imgModalClose()"
            class="img-popup"
        >
            <div class="img-popup__block">
                <div class="img-popup__block__wrapper">
                    <div @click="imgModal = false" class="img-popup__close">
                        <img src="../../images/cancel.svg" alt="" />
                    </div>
                    <img :src="src" alt="" />
                </div>
            </div>
        </div>
        <div :class="{ active: alert.accept === 1 }" class="alert-errors">
            {{ alert.title }}
        </div>
    </main>
</template>
<script>
import axios from "axios";
import Calendar from "./UI/Calendar.vue";

export default {
    components: {
        Calendar
    },
    props: ["addressbooks"],
    data: () => ({
        imgModal: false,
        show: 1,
        unsubscribe: "{{unsubscribe_url}}",
        alert: {
            title: "",
            accept: 0
        },
        src: "https://codernote.ru/files/keyboard.jpg",
        item: {
            adressBook: {
                title: "Выберите адресную книгу",
                index: 0
            },
            adressSend: {
                title: "Значение",
                index: 0
            },
            name: "",
            topic: "",
            headerName: ""
        },
        form: {
            preheader: "",
            image: null,
            address_book_id: null,
            subject: "",
            sender_name: "",
            date_send: null
        },
        modeSend: null
    }),
    watch: {
        modeSend(n, o) {
            if (n === 1) {
                this.form.date_send = null;
            }
        }
    },
    computed: {
        selectedAddressBook() {
            if (this.form.address_book_id) {
                return this.getAddressBookById(this.form.address_book_id);
            }
            return null;
        }
    },
    methods: {
        adressCurrent(selectedIndex) {
            if (selectedIndex[0] != undefined && selectedIndex[1] === 1) {
                this.item.adressBook.index = selectedIndex[0];
            }
            if (selectedIndex[0] != undefined && selectedIndex[1] === 2) {
                this.item.adressSend.index = selectedIndex[0];
            }
        },
        imgModalClose() {
            this.imgModal = false;
        },

        /**
         * @param {Number} id
         * @returns {object|Undefined}
         */
        getAddressBookById(id) {
            return this.addressbooks.find(item => item.id === id);
        },
        step(stepCurrent) {
            this.$notify({
                group: "foo",
                text: "Файл успешно загружен"
            });
            if (stepCurrent === 1) {
                if (
                    this.form.address_book_id != 0 &&
                    this.form.sender_name != "" &&
                    this.form.subject != ""
                ) {
                    this.show = 2;
                } else {
                    this.alert.title = "Заполните все параметры";
                    this.alert.accept = 1;
                    setTimeout(() => {
                        this.alert.accept = 0;
                    }, 4000);
                }
            }
            if (stepCurrent === 2) {
                if (this.form.preheader != "") {
                    this.show = 3;
                } else {
                    this.alert.title = "Заполните все параметры";
                    this.alert.accept = 1;
                    setTimeout(() => {
                        this.alert.accept = 0;
                    }, 4000);
                }
            }
        },
        selectImage() {
            this.form.image = event.target.files[0];
            const reader = new FileReader();
            reader.addEventListener("load", e => {
                this.src = e.target.result;
            });
            reader.readAsDataURL(this.form.image);
        },
        createEmailMailing() {
            const form = new FormData();
            form.append("preheader", this.form.preheader);
            form.append("image", this.form.image);
            form.append("address_book_id", this.form.address_book_id);
            form.append("subject", this.form.subject);
            form.append("sender_name", this.form.sender_name);
            if (this.form.date_send !== null) {
                form.append("date_send", this.form.date_send);
            }
            axios
                .post(route("email.store"), form, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "Cache-Control": "no-cache"
                    }
                })
                .then(res => {
                    console.log(res);
                });
        }
    }
};
</script>
