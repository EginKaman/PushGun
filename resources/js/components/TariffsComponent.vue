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
                            Текущий тарифный план: <span>9 000 - 10 000</span>
                        </p>
                        <div class="tariffs-table__wrapper">
                            <ul class="tariffs-table__wrapper-head">
                                <li><p>Подписчиков</p></li>
                                <li><p>Цена в месяц</p></li>
                                <li><p>Цена в год</p></li>
                                <li><p></p></li>
                            </ul>
                            <ul
                                v-for="item in items"
                                :key="item.id"
                                class="tariffs-table__wrapper-body"
                            >
                                <li>
                                    <span>Подписчиков</span>
                                    <p>
                                        {{ item.subscribe }}
                                        <a>{{ item.accept }}</a>
                                    </p>
                                </li>
                                <li>
                                    <span>Цена в месяц</span>
                                    <p>{{ item.priceForMonth }}</p>
                                </li>
                                <li>
                                    <span>Цена в год</span>
                                    <div>
                                        <p>{{ item.priceForYear }}</p>
                                        <a>{{ item.priceForYearAction }}</a>
                                    </div>
                                </li>
                                <li>
                                    <p>
                                        <label
                                            ><input name="inp" type="radio"
                                        /></label>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subscribe-info">
                <p>Подписка: <span>9 000 - 10 000 (2 080 руб./месяц)</span></p>
            </div>
            <div style="margin-top: 30px" class="button_green mr-24">
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
                            Текущий тарифный план: <span>9 000 - 10 000</span>
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
        items: [
            {
                subscribe: "7 000 - 8 000",
                priceForMonth: "2 600 руб",
                priceForYearAction: "2 600 руб",
                priceForYear: "2 080 руб",
                accept: ""
            },
            {
                subscribe: "7 000 - 8 000",
                priceForMonth: "2 600 руб",
                priceForYearAction: "2 600 руб",
                priceForYear: "2 080 руб",
                accept: ""
            },
            {
                subscribe: "7 000 - 8 000",
                priceForMonth: "2 600 руб",
                priceForYearAction: "2 600 руб",
                priceForYear: "2 080 руб",
                accept: "Текущий"
            }
        ]
    }),
    methods: {
        func(item) {
            this.showModal = item;
        },
        closePopup() {
            this.showPopup = false;
        }
    }
};
</script>
