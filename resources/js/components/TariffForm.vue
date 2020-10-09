<template>
    <div class="tariff-form">
        <div class="tarim-top">
            <h3 class="tariff-title">PRO</h3>
            <strong class="tariff-subtitle number-followers">
                {{ $t('от 30 000 подписчиков') }}
            </strong>
            <div class="tariff-slider"></div>
            <div class="tariff-slider-val">
                <div class="tariff-slider__item active" v-for="tariff in tariffs" :key="tariff.id"
                     data-text="от 30 000 подписчиков"
                     data-price="3900">
                    <span class="tariff-slider__point"></span>
                    <span class="tariff-slider__text" v-if="tariff.max_followers > 0">
                        {{ tariff.max_followers / 1000 }}к
                    </span>
                    <span class="tariff-slider__text" v-else>∞</span>
                </div>
            </div>
            <ul class="tariff-offer">
                <li>{{ $t('Отсутствие ссылки «Работает с помощью Push.Gun» в окне запроса подписки') }}</li>
                <li>{{ $t('Приоритетная поддержка') }}</li>
            </ul>
            <label for="sale" class="tariff-check">
                <input type="checkbox" name="sale" id="sale">
                <span class="check"></span>
                <span class="tariff-check__text">{{ $t('Подписка на год') }} - 20%</span>
            </label>
        </div>

        <div class="tariff-bottom">
            <span class="tariff-price">
                <span id="tariff-price"> 3900</span> {{ $t('руб./мес.') }}
            </span>
            <input type="hidden" name="" class="followsCount" value="30к">

            <button-payment
                :public_id="public_id"
                :account_id="account_id"
                desctiption="Тариф ПРО"
                :amount="3900"></button-payment>
        </div>
    </div>
</template>

<script>

export default {
    name: "TariffForm",
    props: {
        tariffs: Array,
        public_id: {
            type: String,
            default: ''
        },
        account_id: {
            type: String,
            default: ''
        },
    },
}
</script>
