<template>
    <main>
        <div
            v-for="emailmailing in emailmailings"
            :key="emailmailing.id"
            class="general__sites"
        >
            <div class="general__sites_item mails__sites">
                <div class="flex">
                    <a href="">
                        <img
                            class="general__sites_item-img"
                            src="/../../images/site.svg"
                        />
                    </a>
                    <div class="general__sites_info mails__sites_info">
                        <a href="/email/show">{{ emailmailing.subject }}</a>
                        <p>
                            <img src="/../../images/mark.svg" alt="" />
                            Отправлено:
                            {{
                                new Date(
                                    emailmailing.date_send
                                        ? emailmailing.date_send
                                        : emailmailing.created_at
                                ).toLocaleString()
                            }}
                        </p>
                        <p
                            class="pointer"
                            @click="
                                openAddressbook(emailmailing.address_book.id)
                            "
                        >
                            <img src="/../../images/siteDark.svg" alt="" />
                            {{ emailmailing.address_book.name }}
                        </p>
                    </div>
                </div>
                <div class="mails__sites_stats">
                    <div class="mails__sites_stats-item">
                        <h3>2</h3>
                        <p>отправлено</p>
                    </div>
                    <div class="mails__sites_stats-item">
                        <h3>2</h3>
                        <p>доставлено</p>
                    </div>
                    <div class="mails__sites_stats-item">
                        <h3>2</h3>
                        <p>переходов</p>
                    </div>
                </div>
                <div
                    @click="openPopup(emailmailing.id)"
                    class="mails__sites_stats-item-menus"
                >
                    <span>...</span>
                </div>
                <div
                    v-click-outside="closePopup"
                    v-if="show === emailmailing.id"
                    class="general__sites__item-modal"
                >
                    <a
                        ><img src="/../../images/stat1.svg" alt="" />
                        <p>Сатистика</p></a
                    >
                    <a
                        ><img src="/../../images/stat2.svg" alt="" />
                        <p>Обзор рассылки</p></a
                    >
                    <a
                        ><img src="/../../images/stat3.svg" alt="" />
                        <p>Копировать в новую</p></a
                    >
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import vClickOutside from "v-click-outside";
export default {
    directives: {
        clickOutside: vClickOutside.directive
    },
    data: () => ({
        show: null
    }),
    props: ["emailmailings"],
    methods: {
        openPopup(item) {
            this.show = item;
        },
        closePopup() {
            this.show = false;
        },
        /**
         * @param {Number} id address book id
         */
        openAddressbook(id) {
            window.open(route("contact.show", id), "_blank");
        }
    }
};
</script>
