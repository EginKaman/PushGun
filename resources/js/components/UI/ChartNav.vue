<template>
    <div class="general__stats_right-buttons">
        <!-- 		<div class="general__stats_right-double_button">
                    <button class="button button_left-btn selected" @click="group = 'day'">По дням</button>
                    <button class="button button_right-btn" @click="group = 'week'">По неделям</button>
                </div> -->
        <select class="stats__selector" v-model="range">
            <option value="week">{{ $t('За неделю') }}</option>
            <option value="month">{{ $t('За месяц') }}</option>
            <option value="year">{{ $t('За год') }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: 'ChartNav',
    data() {
        return {
            range: 'week',
            group: 'day'
        }
    },
    watch: {
        range() {
            this.$store.dispatch('services/FETCH_STATISTICS', this.range)
        },
        group() {
            console.log(this.group)
        }
    }
}
</script>
