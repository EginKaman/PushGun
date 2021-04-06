<template>
    <main>
        <div class="contact-table">
            <a
                :href="
                    route('addressbook.export', {
                        id: book.id
                    })
                "
                target="_blank"
                class="contact-table__btn"
                >Экспорт</a
            >
            <div
                v-for="(contact, index) in book_contacts.data"
                :key="index"
                class="contact-table__wrapper"
            >
                <ul>
                    <li>{{ contact.address }}</li>
                    <li>Телефон</li>
                    <li>Имя</li>
                    <li>
                        {{
                            new Date(contact.created_at).toLocaleString("en-GB")
                        }}
                    </li>
                    <li @click="func(contact.id)">...</li>
                </ul>
                <div
                    v-if="showModal === contact.id"
                    class="contact-table__modal"
                >
                    <div
                        @click="showModal = null"
                        class="contact-table__modal__close"
                    >
                        x
                    </div>
                    <div class="contact-table__modal__body pointer">
                        <p @click="deleteContact(contact.id)">Удалить</p>
                    </div>
                </div>
            </div>
            <!-- <div class="contact-table__pagination">
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
                <img src="../../images/right.svg" />
            </div> -->
        </div>
    </main>
</template>

<script>
import axios from "axios";
export default {
    data: () => ({
        showModal: null,
        book: {},
        book_contacts: {
            data: []
        }
    }),
    props: ["addressbook", "contacts"],
    methods: {
        func(item) {
            this.showModal = item;
        },
        deleteContact(id) {
            axios
                .delete(route("contact.destroy"), {
                    params: {
                        addressbook_id: this.addressbook.id,
                        contact_id: id
                    }
                })
                .then(res => {
                    if (res.status === 202) {
                        this.book = res.data.addressbook;
                    }
                });
        }
    },
    mounted() {
        this.book = this.addressbook;
        this.book_contacts = this.contacts;
    }
};
</script>
