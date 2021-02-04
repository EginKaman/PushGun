<template>
    <div class="button_green mr-24">
        <span class="green_button_circle"></span>
        <a class="button_green_inner payment-btn">
            <p class="button_text_container">
                <img src="../../../../images/payment.svg" alt="" />Вывести
                деньги
            </p>
        </a>
        <div class="rss__wrapper payment">
            <div class="rss__wrapper__block">
                <div class="rss__wrapper__block__head">
                    <p>Выберите способ оплаты</p>
                    <p class="close-payment">x</p>
                </div>
                <div class="rss__wrapper__block__content">
                    <div class="rss__wrapper__block__content__btn">
                        <a class="visa" @click="select('Money')"
                            ><img src="../../../../images/payer1.svg" alt=""
                        /></a>
                        <a class="visa" @click="select('Webmoney')"
                            ><img src="../../../../images/payer2.svg" alt=""
                        /></a>
                        <a class="visa" @click="select('Visa')"
                            ><img src="../../../../images/payer3.svg" alt=""
                        /></a>
                    </div>
                    <div class="rss__wrapper__block__content__last">
                        <p>Номер счета</p>
                        <input
                            type="text"
                            v-model="card"
                            v-mask="mask"
                            :key="mask"
                        />
                        <div class="button_green mr-24">
                            <span class="green_button_circle"></span>
                            <a
                                @click="submit"
                                class="button_green_inner payment-btn"
                            >
                                <p class="button_text_container">
                                    <img
                                        src="../../../../images/payment.svg"
                                        alt=""
                                    />Отправить
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "WithdrawalBonus",
    data: () => ({
        mask: "",
        card: null
    }),
    methods: {
        select(type) {
            this.card = null;
            if (type === "Money") {
                this.mask = "#### #### #### ####";
            } else if (type === "Webmoney") {
                this.mask = "A###########";
            } else if (type === "Visa") {
                this.mask = "#### #### #### ####";
            }
        },
        submit() {
            const cardNumber = this.card.replace(/\s+/g, "").toUpperCase();
            const form = new FormData()
            form.append('card_number', cardNumber)
            form.append('amount', 55500)
            form.append('wallet_name', 'qiwi')
            axios.post(route('bonus.withdrawal'), form).then(res => console.log(res))
        }
    }
};
</script>

<style lang="scss" scoped></style>
