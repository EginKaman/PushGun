<template>
    <div class="button_green mr-24">
        <span class="green_button_circle"></span>
        <a href="#" @click="open" class="button_green_inner">
            <p class="button_text_container">
                <img src="/images/book.svg" alt="" />{{
                    $t("Новая адресная книга")
                }}
            </p>
        </a>
        <NewAddressBook
            v-if="show"
            @close="close"
            :action="route('addressbook.store')"
        />
    </div>
</template>

<script>
import NewAddressBook from "./Modals/NewAddressBook";
export default {
    props: {},
    components: {
        NewAddressBook
    },
    data: () => ({
        show: false
    }),
    methods: {
        close() {
            this.show = false;
        },
        open() {
            this.show = true;
        }
    }
};
</script>

<style lang="scss" scoped></style>
