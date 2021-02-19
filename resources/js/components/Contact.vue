<template>
    <main v-if="addressbooks.length">
        <div v-for="addressbook in addressbooks" :key="addressbook.id">
            <div class="contact-block">
                <div class="contact-block__wrapper">
                    <span>{{
                        new Date(addressbook.created_at).toLocaleDateString()
                    }}</span>
                    <a>{{ addressbook.name }}</a>
                    <p>
                        Подписчиков:
                        <span>{{ addressbook.contacts_count }}</span>
                    </p>
                </div>
                <div class="contact-block__wrapper right">
                    <div class="contact-block__wrapper__item">
                        <p>{{ addressbook.contacts_count }}</p>
                        <span>e-mail</span>
                    </div>
                    <div class="contact-block__wrapper__item">
                        <p>0</p>
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
        <NewAddressBook v-if="show" @close="closePopup" :action="action"/>
    </main>
</template>

<script>
import vClickOutside from "v-click-outside";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import axios from "axios";
import NewAddressBook from './UI/Modals/NewAddressBook'

export default {
    name: "Contact",
    directives: {
        clickOutside: vClickOutside.directive
    },
    components: {
        NewAddressBook
    },
    props: {
        addressbooks: {
            type: Array,
            default() {
                return [];
            }
        },
        action: {
            type: String,
            required: true
        }
    },
    data: () => ({
        show: false,
    }),
    methods: {
        closePopup() {
            this.show = false;
        },
    }
};
</script>
