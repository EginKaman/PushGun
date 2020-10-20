<template>
    <div class="button_rb tariff-bay">
        <span class="rb_button_circle">
        </span>
        <button class="button_rb_inner" @click.prevent.slider="payment">
            <p class="rb_button_text_container">
                {{ $t('Купить') }}
            </p>
        </button>
    </div>
</template>

<script>
export default {
    name: "ButtonPayment",
    props: {
        public_id: {
            type: String,
            default: ''
        },
        account_id: {
            type: String,
            default: ''
        },
        description: {
            type: String,
            default: ''
        },
        amount: {
            type: Number,
            default: 0
        },
        tariff: {
            type: Number,
            default: 0
        },
        yearly: {
            type: Boolean,
            default: false
        },

    },
    methods: {
        payment() {

            this.pay();

        },
        pay() {
            let widget = new cp.CloudPayments();
            widget.pay('auth', // или 'charge'
                { //options
                    publicId: this.public_id, //id из личного кабинета
                    description: this.description, //назначение
                    amount: this.amount, //сумма
                    currency: 'RUB', //валюта
                    // invoiceId: '1234567', //номер заказа  (необязательно)
                    accountId: this.account_id, //идентификатор плательщика (необязательно)
                    skin: "modern", //дизайн виджета (необязательно)
                    data: {
                        tariff: this.tariff,
                        yearly: this.yearly

                    }
                },
                {
                    onSuccess: function (options) { // success
                        location.reload();
                    },
                    onFail: function (reason, options) { // fail
                        //действие при неуспешной оплате
                    },
                    onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                        //например вызов вашей аналитики Facebook Pixel
                    }
                }
            )
        }
    }
}
</script>
