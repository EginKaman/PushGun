<template>
    <main>
        <div class="create-push-mail">
            <form>
                <div class="sms-create__wrapp">
                    <div class="create-push-mail__block">
                        <div class="create-push-mail__block__item">
                            <p>SMS от</p>
                            <input
                                placeholder="Значение"
                                v-model="form.sender_name"
                                type="text"
                            />
                        </div>
                        <div class="create-push-mail__block__item">
                            <p>Текст уведомления</p>
                            <textarea
                                placeholder="Тектс"
                                v-model="form.text"
                                name=""
                                id=""
                                cols="30"
                                rows="10"
                            ></textarea>
                        </div>
                        <div class="create-push-mail__block__item">
                            <p>Получатели</p>
                            <select v-model="whoToSend">
                                <option value="contacts">Ручной ввод</option>
                                <option value="addressbooks"
                                    >Адресная книга</option
                                >
                            </select>
                            <textarea
                                v-if="whoToSend === 'contacts'"
                                placeholder="Введите номера телефонов, каждый номер с новой строки. Вы можете добавить не более 500 контактов"
                                style="margin-top: 15px"
                                name=""
                                v-model="contacts"
                                id=""
                                cols="30"
                                rows="10"
                            ></textarea>
                        </div>
                        <div
                            class="create-push-mail__block__item"
                            v-if="whoToSend === 'addressbooks'"
                        >
                            <p>Адресная книга</p>
                            <select v-model="form.address_book_id">
                                <option disabled selected>Выбрать</option>
                                <option
                                    v-for="addressbook in addressbooks"
                                    :key="addressbook.id"
                                    :value="addressbook.id"
                                >
                                    {{ addressbook.name }}
                                </option>
                            </select>
                        </div>
                        <div class="create-push-mail__block__item radiobox">
                            <p>Время отправки:</p>
                            <label>
                                <input
                                    name="send"
                                    value="promptly"
                                    v-model="modeSend"
                                    type="radio"
                                />
                                <p>Немедленно</p>
                            </label>
                            <div class="cal">
                                <label>
                                    <input
                                        name="send"
                                        value="time"
                                        v-model="modeSend"
                                        type="radio"
                                    />
                                    <p style="margin-right: 20px">
                                        Начать отправку
                                    </p>
                                </label>
                                <calendar
                                    placeholder="Выберите дату"
                                    calendarType="single"
                                    @selectedDate="
                                        date =>
                                            (date_send = new Date(
                                                date
                                            ).toLocaleString())
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
                    <div class="sms-create__wrapp-img">
                        <div>
                            <div>
                                <img
                                    src="../../images/iphone-group.png"
                                    alt=""
                                />
                                <p>{{ form.text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button @click.prevent="submit">Начать рассылку</button>
            </form>
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
        contacts: "",
        whoToSend: "contacts",
        date_send: null,
        modeSend: "",
        form: {
            sender_name: "",
            text: "",
            date_send: null,
            contacts: null,
            address_book_id: null
        }
    }),
    watch: {},
    methods: {
        isPhoneNumber(phoneNumber) {
            const pattern = new RegExp(/^[0-9]+$/);
            return pattern.test(phoneNumber);
        },
        submit() {
            if (this.modeSend === "promptly") {
                this.form.date_send = null;
            } else if (this.modeSend === "time") {
                this.form.date_send = this.date_send;
            }
            if (this.whoToSend === "contacts") {
                this.form.contacts = [];
                this.form.address_book_id = null;
                this.contacts.split("\n").forEach(contact => {
                    if (this.isPhoneNumber(contact)) {
                        this.form.contacts.push(contact);
                    }
                });
            } else if (this.whoToSend === "addressbooks") {
                this.form.contacts = null;
            }
            if (!this.form.contacts && !this.form.address_book_id) {
                return;
            }
            axios.post(route("sms.store"), this.form).then(res => {
                if (res.status === 201) {
                    window.location.href = route("email.index");
                } else if (res.status === 200 && res.data?.msg) {
                    alert(res.data.msg)
                }
            });
        }
    }
};
</script>
