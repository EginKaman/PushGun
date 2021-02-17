<template>
    <div class="button_green mr-24">
        <span class="green_button_circle"></span>
        <a class="button_green_inner" @click="open">
            <p class="button_text_container">
                <img src="../../../../images/payment.svg" alt="" />Вывести
                деньги
            </p>
        </a>
        <div class="rss__wrapper payment" v-show="isActive">
            <div class="rss__wrapper__block">
                <div class="rss__wrapper__block__head">
                    <p>Выберите способ оплаты</p>
                    <p class="close-payment" @click="close">x</p>
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
                    <a
                        class="visa"
                        id="custom-option-select-wallet-name"
                    >
                        <p @click="select(null)">Свой Вариант</p>
                    </a>
                    <div class="rss__wrapper__block__content__last">
                        <div v-if="isShowInputForCustomWalletName">
                            <p>Как вы хотите получить деньги</p>
                            <input
                                type="text"
                                v-model="wallet_name"
                            />
                        </div>
                        <p>Номер счета</p>
                        <input
                            type="text"
                            v-model="card"
                            v-mask="mask"
                            :key="mask"
                        />
                        <p>Сумма</p>
                        <input type="number" min="0" v-model="amount" />
                        <span v-if="message">{{ message.message }}</span>
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
        card: null,
        amount: 0,
        message: null, // message, type,
        isActive: false,
        wallet_name: null,
        isShowInputForCustomWalletName: false
    }),
    methods: {
        select(type) {
            if (type === null) {
                this.isShowInputForCustomWalletName = true;
                this.mask = ''
            } else {
                this.isShowInputForCustomWalletName = false
            }
            this.wallet_name = type;
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
            const form = new FormData();
            form.append("card_number", cardNumber);
            form.append("amount", this.amount);
            form.append("wallet_name", this.wallet_name);
            axios.post(route("bonus.withdrawal"), form).then(res => {
                this.message = res.data;
                setTimeout(() => {
                    this.close();
                }, 1500);
            });
        },
        open() {
            this.isActive = true;
        },
        close() {
            this.isActive = false;
            this.amount = 0;
            this.card = null;
        }
    }
};
</script>

<style lang="scss" scoped></style>
