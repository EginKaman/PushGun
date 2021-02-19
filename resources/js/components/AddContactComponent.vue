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
                                v-model="contacts"
                                id=""
                                cols="30"
                                rows="10"
                                placeholder="@pushgun"
                            ></textarea>
                        </label>
                    </div>
                </div>
            </div>
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a @click.prevent="submit" class="button_green_inner">
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
    props: {
        action: {
            type: String,
            default: ""
        },
        addressbook: {
            type: Object,
            required: true
        }
    },
    methods: {
        isEmail(emailAddress) {
            const pattern = new RegExp(
                /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
            );
            return pattern.test(emailAddress);
        },
        submit() {
            const contacts = this.contacts
                .split("\n")
                .map(contact => {
                    contact = contact.replace(/\s+/g, "");
                    if (this.isEmail(contact)) {
                        return contact;
                    }
                })
                .filter(contact => contact);
            axios.post(this.action, {
                contacts,
                addressbook_id: this.addressbook.id
            })
            .then(res => {
              if(res.status) {
                window.location.replace(route('addressbook.index'))
              }
            })
        }
    }
};
</script>
