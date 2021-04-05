<template>
    <main>
        <div class="addContact">
            <div class="addContact__head">
                <a @click="show = false" :class="{ active: show === false }"
                    >Загрузить файл</a
                >
                <a @click="show = true" :class="{ active: show === true }"
                    >Добавить вручную</a
                >
            </div>
            <div v-if="show === false" class="addContact__wrapper">
                <div class="addContact__wrapper__item">
                    <div>
                        <p>Файл для загрузки:</p>
                    </div>
                    <div>
                        <span>Поддерживаемые форматы: TXT, CSV, XLS, XLSX</span>
                        <label>
                            <input class="file" type="file" />
                            <p>
                                <img src="../../images/plusik.svg" />Добавить
                                файл
                            </p>
                        </label>
                    </div>
                </div>
            </div>
            <div v-else class="addContact__wrapper">
                <div class="addContact__wrapper__item">
                    <div>
                        <p>Список контактов:</p>
                    </div>
                    <div>
                        <span
                            >Можно ввести не более 1 000 контактов. Разделить
                            между адресами - перенос строки</span
                        >
                        <label>
                            <textarea
                                name=""
                                id=""
                                cols="30"
                                v-model="contacts"
                                rows="10"
                                placeholder="@pushgun"
                            ></textarea>
                        </label>
                    </div>
                </div>
            </div>
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a class="button_green_inner" @click="submit">
                    <p class="button_text_container">
                        <img src="" alt="" />Добавить
                    </p>
                </a>
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";
export default {
    data: () => ({
        show: false,
        contacts: ""
    }),
    props: ["addressbook"],
    methods: {
        isEmail(emailAddress) {
            const pattern = new RegExp(
                /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
            );

            return pattern.test(emailAddress);
        },
        isPhoneNumber(phoneNumber) {
            const pattern = new RegExp(/^[0-9]+$/);
            return pattern.test(phoneNumber);
        },
        submit() {
            const emails = [];
            const numbers = [];
            this.contacts.split("\n").forEach(contact => {
                if (this.isEmail(contact)) {
                    emails.push(contact);
                } else if (this.isPhoneNumber(contact)) {
                    numbers.push(contact);
                }
            });
            axios
                .post(route("contact.store"), {
                    emails,
                    numbers,
                    addressbook_id: this.addressbook.id
                })
                .then(res => {
                    if (res.status === 201) {
                        window.location.href = route(
                            "contact.show",
                            res.data.addressBook.id
                        );
                    }
                });
        }
    }
};
</script>
