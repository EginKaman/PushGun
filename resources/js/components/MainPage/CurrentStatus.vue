<template>
    <div class="current__stats" v-if="visibleStatistic">
        <div class="current__stats_item" v-for="(item, index) in statisticsParam" :key="index">
            <h3 :style="{color: item.color}">{{ item.count }}</h3>
            <p class="current__stats_desc">
                <span v-if="item.percent != undefined && item.percent != 0">{{ item.percent }}%</span>
                <span>{{ $t(item.title) }}</span>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "CurrentStatus",
    data() {
        return {
            visibleStatistic: true,
        }
    },
    computed: {
        statistic() {
            return this.$store.state.services.statistics
        },
        statisticsParam() {
            return this.$store.state.services.statisticsParam
        }
    },
    methods: {
        countNumber() {

        }
    },
    watch: {
        statistic: {
            handler() {
                this.visibleStatistic = false

                for (var i in this.statisticsParam) {
                    if (this.statistic[i].length == 0) {
                        this.statisticsParam[i].count = 0
                    } else {
                        this.statisticsParam[i].count = this.statistic[i]
                            .map(item => item.count)
                            .reduce((ac, el) => ac + el)
                    }
                }

                // TODO расчет процентов для доаствленых уведомлений и количества переходов по ним
                // нужно будет оптимизировать

                if (this.statisticsParam.delivered.count != 0 && this.statisticsParam.sent.count != 0)
                    this.statisticsParam.delivered.percent = (this.statisticsParam.sent.count / this.statisticsParam.delivered.count) * 100

                if (this.statisticsParam.conversions.count != 0 && this.statisticsParam.delivered.count)
                    this.statisticsParam.conversions.percent = Number((this.statisticsParam.conversions.count / this.statisticsParam.delivered.count) * 100).toFixed(2);

                this.visibleStatistic = true
            },
            deep: true
        }
    }
}
</script>

<style scoped lang="scss">

</style>
