<template>
    <main>
        <div style="margin-top: 24px" class="email-push-show__tabs">
            <a @click="show = 1" :class="{ active: show === 1 }"
                >E-Mail рассылка</a
            >
            <a @click="show = 2" :class="{ active: show === 2 }"
                >SMS рассылка</a
            >
        </div>
        <div v-if="show === 1">
            <div class="tariffs-block">
                <div class="tariffs-table">
                    <div class="tariffs-table__title">
                        <p>
                            Текущий тарифный план:
                            <span>
                                {{ user.tariff_email.name }}
                            </span>
                        </p>
                        <div class="tariffs-table__wrapper">
                            <ul class="tariffs-table__wrapper-head">
                                <li><p>Подписчиков</p></li>
                                <li><p>Цена в месяц</p></li>
                                <li><p>Цена в год</p></li>
                                <li><p></p></li>
                            </ul>
                            <ul
                                v-for="tariff in tariffs_email"
                                :key="tariff.id"
                                class="tariffs-table__wrapper-body"
                            >
                                <li>
                                    <span>Подписчиков</span>
                                    <p>
                                        {{ tariff.max_contacts }}
                                        <a
                                            v-if="
                                                tariff.id ===
                                                    user.tariff_email.id
                                            "
                                        >
                                            Текущий
                                        </a>
                                    </p>
                                </li>
                                <li>
                                    <span>Цена в месяц</span>
                                    <a>{{ tariff.price_per_month }} руб</a>
                                </li>
                                <li>
                                    <span>Цена в год</span>
                                    <div>
                                        <a
                                            >{{
                                                tariff.price_per_year / 12
                                            }}
                                            руб</a
                                        >
                                        <!-- <a>{{ item.priceForYearAction }}</a> -->
                                    </div>
                                </li>
                                <li>
                                    <p>
                                        <label
                                            ><input
                                                v-model="tariff_email"
                                                :value="tariff.id"
                                                type="radio"
                                        /></label>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subscribe-info">
                <p>
                    Подписка:
                    <span v-if="selectedTariff">
                        {{ selectedTariff.name }} <br />
                        {{ selectedTariff.price_per_month }} руб/месяц
                    </span>
                </p>
            </div>
            <div
                style="margin-top: 30px"
                class="button_green mr-24"
                v-if="tariff_email !== user.tariff_email.id"
            >
                <span
                    class="green_button_circle desplode-circle"
                    style="left: 51px; top: 43.125px;"
                >
                </span>
                <a class="button_green_inner">
                    <p class="button_text_container">
                        Купить
                    </p>
                </a>
            </div>
        </div>
        <div v-if="show === 2">
            <div class="tariffs-block">
                <div class="tariffs-table">
                    <div class="tariffs-table__title">
                        <p>
                            Текущий тарифный план:
                        </p>
                        <button>Пополнить счет</button>
                    </div>
                </div>
            </div>
            <div style="margin-top: 24px" class="tariffs-block">
                <div class="tariffs-table">
                    <div class="tariffs-table__wrapper">
                        <ul
                            style="grid-template-columns: 1fr 1fr"
                            class="tariffs-table__wrapper-head"
                        >
                            <li><p>Оператор</p></li>
                            <li><p>Прямой канал руб/смс</p></li>
                        </ul>
                        <ul
                            v-for="item in 3"
                            :key="item.id"
                            style="grid-template-columns: 1fr 1fr"
                            class="tariffs-table__wrapper-body"
                        >
                            <li>
                                <span>Оператор</span>
                                <p>
                                    Beeline
                                </p>
                            </li>
                            <li>
                                <span>Прямой канал руб/смс</span>
                                <p>32</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="subscribe-info"></div>
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
        showPopup: false,
        showModal: null,
        show: 1,
        tariff_email: null
    }),
    props: ["tariffs_email", "user"],
    methods: {
        func(item) {
            this.showModal = item;
        },
        closePopup() {
            this.showPopup = false;
        }
    },
    computed: {
        selectedTariff() {
            return this.tariffs_email.find(
                tariff => tariff.id === this.tariff_email
            );
        }
    },
    mounted() {
        if (this.user) {
            this.tariff_email = this.user.tariff_email?.id;
        }
    }
};
</script>
