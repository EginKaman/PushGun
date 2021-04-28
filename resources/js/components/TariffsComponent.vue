<template>
    <main>
        <div style="margin-top: 24px" class="email-push-show__tabs">
            <a @click="show = 1" :class="{ active: show === 1 }"
                >E-Mail рассылка</a
            >
            <a @click="show = 2" :class="{ active: show === 2 }"
                >SMS рассылка</a
            >
            <a
                @click="isShowTopUpAccountModal = true"
                :class="{ active: isShowTopUpAccountModal }"
            >
                Пополнить счет
            </a>
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
                class="tariff-bottom tariff_component_btn_payment"
                v-if="tariff_email !== user.tariff_email.id"
            >
                <button-payment
                    :public_id="public_id"
                    :account_id="account_id"
                    :desctiption="'Тариф' + selectedTariff.name"
                    :tariff="selectedTariff.id"
                    :yearly="false"
                    :amount="selectedTariff.price_per_month"
                    tariff_type="mail"
                ></button-payment>
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
        <div
            v-if="isShowTopUpAccountModal"
            v-click-outside="() => (isShowTopUpAccountModal = false)"
            class="contact-popup"
        >
            <div class="contact-popup__block">
                <div class="contact-popup__block__head">
                    <p>Пополнение баланса</p>
                    <span>
                        Текущий баланс: 1000 руб
                    </span>
                    <img
                        @click="isShowTopUpAccountModal = false"
                        src="../../images/business-close.svg"
                        alt=""
                    />
                </div>
                <div class="contact-popup__block__sect">
                    <p>Введите сумму (руб)</p>
                    <money
                        v-model="price"
                        v-bind="money"
                        style="margin-top:5px;"
                        placeholder="Сумма"
                    />
                </div>
                <div class="contact-popup__block__foot top_up_account">
                    <button-payment
                        :public_id="public_id"
                        :account_id="account_id"
                        :desctiption="'Пополнение баланса, сумма ' + price"
                        :amount="price"
                        tariff_type="account"
                    ></button-payment>
                    <div style="backgorund: #fafafa" class="button_white">
                        <span class="white_button_circle"></span>
                        <a
                            @click="isShowTopUpAccountModal = false"
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
import { Money } from "v-money";
export default {
    directives: {
        clickOutside: vClickOutside.directive
    },
    components: {
        Money
    },
    data: () => ({
        showPopup: false,
        showModal: null,
        show: 1,
        tariff_email: null,
        isShowTopUpAccountModal: false,
        money: {
            decimal: ",",
            thousands: ".",
            prefix: "",
            suffix: " ₽",
            precision: 0,
            masked: false
        },
        price: 0
    }),
    props: ["tariffs_email", "user", "public_id", "account_id"],
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
