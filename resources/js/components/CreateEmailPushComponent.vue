<template>
    <main>
        <div class="create-push-mail">
            <div class="create-push-mail__btn">
                <a @click="show = 1" :class="{ active: show === 1 }"
                    >1<span>.Информация о рассылке</span></a
                >
                <a @click="show = 2" :class="{ active: show === 2 }"
                    >2<span>.Контент письма</span></a
                >
                <a @click="show = 4" :class="{ active: show === 4 }"
                    >3<span>.Тело письма</span></a
                >
                <a @click="show = 3" :class="{ active: show === 3 }"
                    >4<span>.Предпросмотр и отправка</span></a
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
                            v-model="form.email_sender_id"
                        >
                            <option style="display: none" disabled selected
                                >Значение</option
                            >
                            <option
                                v-for="sender in emailsenders"
                                :value="sender.id"
                                :key="sender.id"
                            >
                                {{ sender.address }}
                            </option>
                        </select>
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
                <button
                    class="button-cm"
                    @click.prevent="step((stepCurrent = 1))"
                >
                    Далее
                </button>
            </form>
            <form v-if="show === 2">
                <div class="create-push-mail__title">
                    <h2>Контент письма</h2>
                </div>

                <div class="create-push-mail__block">
                    <div class="create-push-mail__content">
                        <div class="preview_email" v-html="form.body"></div>
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
                            <button class="button-cm" @click.prevent="show = 4">
                                Редактировать шаблон
                            </button>
                            <div class="create-push-mail__block__item label">
                                <p>
                                    Прикрепить файл
                                    <img src="../../images/link.svg" alt="" />
                                </p>
                                <label>
                                    <input type="file" @change="onFileChange" />
                                    <span>
                                        {{
                                            uploadFileName ||
                                                "Перетащите файл сюда или кликните, чтобы загрузить их"
                                        }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="button-cm" @click.prevent="step(3)">
                    Далее
                </button>
            </form>
            <form v-if="show === 3">
                <div class="create-push-mail__title editor">
                    <h2>Информация о рассылке</h2>
                    <a v-if="editContent === 1" @click="editContent = null"
                        >Сохранить</a
                    >
                    <a v-if="editContent != 1" @click="editContent = 1"
                        ><span>Редактировать</span>
                        <img src="../../images/pan.svg" alt=""
                    /></a>
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
                        <span v-if="editContent != 1">{{
                            form.sender_name
                        }}</span>
                        <input
                            v-if="editContent === 1"
                            v-model="form.sender_name"
                            type="text"
                            placeholder="Значение"
                        />
                    </div>
                    <div class="create-push-mail__block__item wrapp">
                        <p>Тема сообщения:</p>
                        <span v-if="editContent != 1">{{ form.subject }}</span>
                        <input
                            v-if="editContent === 1"
                            v-model="form.sender_name"
                            type="text"
                            placeholder="Значение"
                        />
                    </div>
                </div>
                <div class="create-push-mail__title editor">
                    <h2>Контент письма</h2>
                    <a @click="editContent = null" v-if="editContent === 2"
                        >Сохранить</a
                    >
                    <a v-if="editContent != 2" @click="editContent = 2"
                        ><span>Редактировать</span>
                        <img src="../../images/pan.svg" alt=""
                    /></a>
                </div>
                <div class="create-push-mail__block">
                    <div class="create-push-mail__content">
                        <div v-html="form.body"></div>
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
                                <p style="font-weight: 400; cursor: pointer">
                                    <img
                                        style="max-width: 15px"
                                        src="../../images/alert1.svg"
                                        alt=""
                                    />

                                    Ссылка на сайт Pushgun будет добавлена внизу
                                    письма.<br />
                                    Чтобы отключить упоминание Pushgun в ваших
                                    рассылках,<br />
                                    подключите один из
                                    <a
                                        style="color: #02acfd; text-decoration: underline"
                                        >платных тарифных планов</a
                                    >
                                </p>
                            </div>
                            <div class="create-push-mail__block__item">
                                <p style="font-weight: 400; cursor: pointer">
                                    <img
                                        style="max-width: 15px"
                                        src="../../images/alert2.svg"
                                        alt=""
                                    />
                                    Почтовые сервисы могут отнести данную
                                    рассылку к спаму.
                                    <a
                                        style="color: #02acfd; text-decoration: underline"
                                        >Получите рекомендации</a
                                    ><br />По улучшению доставляемости
                                </p>
                            </div>
                            <div class="create-push-mail__block__item">
                                <div
                                    v-if="form.unsubscribe === false"
                                    class="create-push-mail__block__item info"
                                >
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
                            <button class="button-cm">Тестовая рассылка</button>
                        </div>
                    </div>
                </div>
                <div class="create-push-mail__block__item info inform">
                    <span></span>
                    <p>
                        Вы собираетесь отправить <a>1 письмо.</a> Из них
                        уникальных подписчиков, которым вы уже отправляли
                        рассылки: <a>0.</a> <br />
                        Общий размер одного письма: <a>748 B</a>
                    </p>
                </div>
                <div class="create-push-mail__title editor">
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
                    <div
                        style="display: none"
                        class="create-push-mail__block__item checkbox"
                    >
                        <label>
                            <input name="send" type="checkbox" />
                            <p>Переотправить рассылку по непрочитанным</p>
                        </label>
                    </div>
                </div>
                <button
                    class="button-cm"
                    v-if="show != 3"
                    @click.prevent="step((stepCurrent = 3))"
                >
                    Далее
                </button>
                <button
                    class="button-cm"
                    v-if="show === 3"
                    @click.prevent="createEmailMailing"
                >
                    Начать рассылку
                </button>
            </form>
            <form v-if="show === 4">
                <div class="create-push-mail__title">
                    <h2>HTML редактор</h2>
                </div>
                <div class="create-push-mail__block">
                    <vue-editor v-model="form.body"></vue-editor>
                    <div class="trumbowyg-inform">
                        <p>
                            Количество слов:
                            <span class="trumbowyg-count">0</span>
                        </p>
                        <div>
                            <p>
                                В теле письма необходимо указать информацию о
                                том, как получатель подписался на вашу рассылку,
                                например:"Вы получили это письмо, так как
                                <br />подписались на рассылку на сайте
                                https://example.com"
                            </p>
                            <p v-if="form.unsubscribe === false">
                                В шаблоне отсутствует ссылка на страницу
                                отписки. Вставьте ее спользуя шорткод:
                                {(unsubscribe_url}} или она будет добавлена
                                автоматически
                            </p>
                        </div>
                    </div>
                    <button class="button-cm" @click.prevent="step(4)">
                        Далее
                    </button>
                </div>
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
                    <div v-for="(image, i) in images">
                        <img :src="image" />
                    </div>
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

// Import editor css
import { VueEditor } from "vue2-editor";

export default {
    components: {
        Calendar,
        VueEditor
    },
    props: ["addressbooks", "emailsenders"],
    data: () => ({
        editContent: null,
        images: [],
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
        uploadFileName: "",
        form: {
            unsubscribe: false,
            preheader: "",
            address_book_id: null,
            subject: "",
            sender_name: "",
            date_send: null,
            body: "",
            email_sender_id: null,
            file: null
        },
        modeSend: null,
        editorConfig: {}
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
        onFileChange(e) {
            const file = e?.target?.files[0];
            this.uploadFileName = file.name;
            this.form.file = file;
        },
        removeImage(index) {
            this.images.splice(index, 1);
        },
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
                    this.form.email_sender_id &&
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
            if (stepCurrent === 3) {
                this.form.unsubscribe = /(?=.*{)(?=.*{)(?=.*})(?=.*})/.test(
                    this.form.body
                );
                console.log(this.form.unsubscribe);
                if (this.form.unsubscribe === false) {
                    console.log("tut pusto");
                } else {
                    console.log("tut bilo ne pusto");
                }
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
            if (stepCurrent === 4) {
                this.show = 2;
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
            if(this.form.file) form.append("file", this.form.file);
            form.append("address_book_id", this.form.address_book_id);
            form.append("subject", this.form.subject);
            // form.append("sender_name", this.form.sender_name);
            form.append("email_sender_id", this.form.email_sender_id);
            form.append("body", this.form.body);
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
                    if (res.status === 201) {
                        window.location.href = route("email.show", res.data.id);
                    }
                });
        }
    }
};
</script>
