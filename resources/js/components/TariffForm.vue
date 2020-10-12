<template>
    <div class="tariff-form">
        <div class="tarim-top">
            <h3 class="tariff-title">PRO</h3>
            <strong class="tariff-subtitle number-followers" v-if="currentFollowers > 0">
                {{ $t('от') }} {{ currentFollowers }} {{ $t('подписчиков') }}
            </strong>
            <strong class="tariff-subtitle number-followers" v-else>
                {{ $t('неограниченно') }}
            </strong>
            <div style="margin-top: 54px">
                <slider-component :items="tariffs" @choosed="activeTarif($event)"/>
            </div>
            <ul class="tariff-offer">
                <li>{{ $t('Отсутствие ссылки «Работает с помощью Push.Gun» в окне запроса подписки') }}</li>
                <li>{{ $t('Приоритетная поддержка') }}</li>
            </ul>
            <label for="sale" class="tariff-check">
                <input type="checkbox" name="sale" id="sale" v-model="subscription">
                <span class="check"></span>
                <span class="tariff-check__text">{{ $t('Подписка на год') }} - 20%</span>
            </label>
        </div>

        <div class="tariff-bottom">
            <span class="tariff-price">
                <span id="tariff-price"> {{ currentTariffAmount }}</span>
                <span v-if="!subscription">{{ $t('руб./мес.') }}</span>
                <span v-else>{{ $t('руб./год') }}</span>
            </span>
            <input type="hidden" name="" class="followsCount" value="30к">

            <button-payment
                :public_id="public_id"
                :account_id="account_id"
                :desctiption="'Тариф' + currentTitle"
                :tariff="currentTariff"
                :yearly="subscription"
                :amount="currentTariffAmount"></button-payment>
        </div>
    </div>
</template>

<script>
import Slider from './UI/Slider.vue'

export default {
    name: "TariffForm",
    data() {
        return {
            currentTariff: this.tariffs[0].id,
            currentTariffAmount: 0,
            currentFollowers: 0,
            currentTitle: '',
            subscription: false
        }
    },
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
    components: {
        sliderComponent: Slider
    },
    mounted() {
        this.activeTarif(this.tariffs[0])
    },
    methods: {
        activeTarif(tarif) {
            this.currentTariff = tarif.id;
            this.currentFollowers = tarif.max_followers;
            this.currentTitle = tarif.title;
            this.currentTariffAmount = this.subscription ? tarif.price_per_year : tarif.price_per_month;
        }
    },
    watch: {
        subscription() {
            this.activeTarif(this.tariffs.find(item => item.id == this.currentTariff))
        }
    }
}
</script>
