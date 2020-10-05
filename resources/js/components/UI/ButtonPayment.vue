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
            default: ''
        },

    },
    methods: {
        payment() {
            let widget = new cp.CloudPayments();
            this.pay = function () {
                widget.pay('auth', // или 'charge'
                    { //options
                        publicId: 'test_api_00000000000000000000001', //id из личного кабинета
                        description: 'Оплата товаров в example.com', //назначение
                        amount: 100, //сумма
                        currency: 'RUB', //валюта
                        invoiceId: '1234567', //номер заказа  (необязательно)
                        accountId: 'user@example.com', //идентификатор плательщика (необязательно)
                        skin: "mini", //дизайн виджета (необязательно)
                        data: {
                            myProp: 'myProp value'
                        }
                    },
                    {
                        onSuccess: function (options) { // success
                            //действие при успешной оплате
                        },
                        onFail: function (reason, options) { // fail
                            //действие при неуспешной оплате
                        },
                        onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                            //например вызов вашей аналитики Facebook Pixel
                        }
                    }
                )
            };

        }
    }
}
</script>
