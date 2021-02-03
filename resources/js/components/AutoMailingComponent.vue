<template>
    <div class="main automailing-vue">
        <div
            :class="{ noActive: showMenus === true }"
            class="button_green mr-24"
        >
            <span class="green_button_circle"></span>
            <a @click="showMenus = true" class="button_green_inner">
                <p class="button_text_container">
                    <img src="../../images/send.svg" alt="" />Создать
                    автоматическую рассылку
                </p>
            </a>
        </div>
        <div v-if="showMenus === true" class="btn-menus">
            <a href="/account/saveMailing" class="btn-menus__item">
                <div class="img-wrap">
                    <img src="../../images/sendmail.svg" alt="" />
                </div>
                <div class="txt-block">
                    <p>Серия сообщений</p>
                    <span
                        >Отправка серии сообщений после подписки на push
                        уведомления</span
                    >
                </div>
            </a>
            <a @click="rssShow = true" class="btn-menus__item rss">
                <div class="img-wrap">
                    <img src="../../images/rss.svg" alt="" />
                </div>
                <div class="txt-block">
                    <p>Рассылка на основе RSS</p>
                    <span
                        >Отправка push сообщеий после добавлеия новых записей в
                        RSS ленте</span
                    >
                </div>
            </a>
            <div v-if="rssShow === true" class="rss__wrapper">
                <div v-click-outside="rssClose" class="rss__wrapper__block">
                    <div class="rss__wrapper__block__head">
                        <p>Укажите ссылку на RSS</p>
                        <p @click="rssShow = false">x</p>
                    </div>
                    <div class="rss__wrapper__block__content">
                        <span>Добавьте ссылку на RSS своего сайта</span>
                        <label>
                            <p>Ссылка на RSS-ленту</p>
                            <input
                                type="text"
                                placeholder="https://example.com/rss"
                            />
                        </label>
                        <div class="rss__wrapper__block__btn">
                            <div class="button_green mr-24">
                                <span class="green_button_circle"></span>
                                <a
                                    href="/account/saveMailingRss"
                                    class="button_green_inner"
                                >
                                    <p class="button_text_container">
                                        Проверить URL
                                    </p>
                                </a>
                            </div>
                            <a @click="rssShow = false" class="clo">Отмена</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="automailings">
            <div
                class="automailing__wrapper"
                v-for="(automailing, index) in automailings"
                :key="automailing.id"
            >
                <div class="automailing__wrapper__item">
                    <span @click="popupModal = index" class="popup-btn"
                        >...</span
                    >
                    <div
                        v-if="popupModal === index"
                        v-click-outside="popupClose"
                        class="popup-block"
                    >
                        <a
                            >Редактировать<img src="../../images/pan.svg" alt=""
                        /></a>
                        <a @click.prevent="deleteAutomailing(automailing.id)"
                            >Удалить<img src="../../images/basket.svg" alt=""
                        /></a>
                    </div>
                    <div class="automailing__wrapper__item__content">
                        <div class="content__wrapp">
                            <div class="content-item">
                                <p class="name">a</p>
                            </div>
                            <div class="content-item">
                                <span>Status ~~</span>
                                <a>{{ automailing.name }}</a>
                                <div class="content-icon">
                                    <div class="content-icon-item">
                                        <img
                                            src="../../images/message.svg"
                                            alt=""
                                        />
                                        <p>0</p>
                                    </div>
                                    <div class="content-icon-item">
                                        <img
                                            src="../../images/calendar.svg"
                                            alt=""
                                        />
                                        <p>
                                            {{
                                                new Date(
                                                    automailing.created_at
                                                ).toLocaleString()
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <div class="change_status_mailing">
                                    <p
                                        v-if="automailing.status.id === 2"
                                        @click="changeStatus(1)"
                                        class="active"
                                    >
                                        Активировать
                                    </p>
                                    <p
                                        v-else
                                        class="stopped"
                                        @click="changeStatus(2)"
                                    >
                                        Остановить
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="automailing__wrapper__item__content">
                        <div class="content-item-count__wrapper">
                            <div class="content-item-count">
                                <span>0 ~~</span>
                                <p>Подписчиков в очереди</p>
                            </div>
                            <div class="content-item-count">
                                <span>{{ automailing.series }}</span>
                                <p>Завершенных серий</p>
                            </div>
                            <div class="content-item-count">
                                <span>{{ automailing.countSentPushes }}</span>
                                <p>Отправлено push</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from "v-click-outside";
import { mapGetters, mapState } from "vuex";
import axios from "axios";

export default {
    name: "AutoMailingComponent",
    directives: {
        clickOutside: vClickOutside.directive
    },
    data() {
        return {
            rssShow: false,
            showMenus: false,
            popupModal: null,
            mailing: [
                {
                    name: "p",
                    status: "Новая",
                    url: "RSS lenta.ru/rss/new",
                    message: 0,
                    data: "26.11.2020 16:00",
                    usersCount: "2",
                    seriesCount: "2",
                    pushCount: "2"
                },
                {
                    name: "a",
                    status: "Активная",
                    url: "123",
                    message: 2,
                    data: "26.11.2020 11:00",
                    usersCount: "3",
                    seriesCount: "2",
                    pushCount: "2"
                }
            ]
        };
    },
    props: {},
    methods: {
        popupClose() {
            this.popupModal = null;
        },
        rssClose() {
            this.rssShow = null;
        },
        deleteAutomailing(id) {
            axios.delete(`/autoMailing/${id}`).then(() => {
                this.popupClose()
                this.$store.dispatch("automailings/FETCH_AUTOMAILINGS");
            });
        },
        changeStatus(statusId) {}
    },
    computed: {
        ...mapState({
            automailings: state => state.automailings.automailings,
            statuses: state => state.state.automailingStatuses.statuses
        }),
        ...mapGetters("automailings", {
            automailings: "getAutomailings"
        }),
        automailings: {
            get() {
                return this.$store.state.automailings.automailings;
            },
            set(value) {
                this.$store.commit("automailings/setAutomailings", value);
            }
        },
        statuses: {
            get() {
                return this.$store.state.automailingStatuses.statuses;
            }
        }
    },
    mounted() {
        this.$store.dispatch("automailings/FETCH_AUTOMAILINGS");
        this.$store.dispatch("automailingStatuses/FETCH_AUTOMAILING_STATUSES");
    }
};
</script>

<style scoped></style>
