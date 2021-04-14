<template>
    <main>
        <div v-for="addressbook in addressbooks" :key="addressbook.id">
            <div class="contact-block">
                <div class="contact-block__wrapper">
                    <span>{{
                        new Date(addressbook.created_at).toLocaleString()
                    }}</span>
                    <a :href="route('contact.show', addressbook.id)">{{
                        addressbook.name
                    }}</a>
                    <p>
                        Контактов: {{ addressbook.contacts_count }}<span></span>
                    </p>
                </div>
                <div class="contact-block__wrapper right">
                    <div class="contact-block__wrapper__item">
                        <p>{{ addressbook.mailsCount }}</p>
                        <span>e-mail</span>
                    </div>
                    <div class="contact-block__wrapper__item">
                        <p>{{ addressbook.numbersCount }}</p>
                        <span>телефонов</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="email-btn">
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a @click="show = true" class="button_green_inner">
                    <p class="button_text_container">
                        <img src="../../images/book.svg" alt="" />Новая адресная
                        книга
                    </p>
                </a>
            </div>
        </div>
        <div v-if="show === true" class="contact-popup">
            <div v-click-outside="closePopup" class="contact-popup__block">
                <div @click="show = false" class="contact-popup__block__head">
                    <p>Новая адресная книга</p>
                    <img src="../../images/business-close.svg" alt="" />
                </div>
                <div class="contact-popup__block__sect">
                    <p>Введите название</p>
                    <input
                        type="text"
                        v-model="form.name"
                        placeholder="Название адресной книги"
                    />
                </div>
                <div class="contact-popup__block__foot">
                    <div class="button_green mr-24">
                        <span class="green_button_circle"></span>
                        <a
                            @click="createAddressbook"
                            class="button_green_inner"
                        >
                            <p class="button_text_container">
                                <img src="" alt="" />Добавить
                            </p>
                        </a>
                    </div>
                    <div style="backgorund: #fafafa" class="button_white">
                        <span class="white_button_circle"></span>
                        <a
                            @click="show = false"
                            style="background: rgb(222 222 222 / 1)"
                            class="button_white_inner"
                        >
                            <p class="button_text_container">
                                <img class="button-img" src="" alt="" />Отмена
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import vClickOutside from "v-click-outside";
import axios from "axios";

export default {
    name: "Contact",
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: ["addressbooks"],
    data: () => ({
        show: false,
        form: {
            name: null
        }
    }),
    methods: {
        closePopup() {
            this.show = false;
        },
        createAddressbook() {
            axios.post(route("addressbook.store"), this.form).then(res => {
                if (res.status === 201) {
                    window.location.href = route(
                        "contact.create",
                        res.data.addressbook.id
                    );
                }
            });
        }
    }
};
</script>
