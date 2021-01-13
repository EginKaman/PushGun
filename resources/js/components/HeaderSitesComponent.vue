<template>
    <div class="nav__menu">
        <ul class="nav__menu_inner">
            <li class="nav__menu_item" v-if="sites.length < 1">
                <a class="nav__menu_link" href="/site/create">{{ $t('Добавить сайт') }}</a>
            </li>
            <li class="nav__menu_item" v-for="(site, index) in sites" :key="index">
                <a class="nav__menu_link" :href="site.url">{{ site.link }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapGetters, mapState} from "vuex";

export default {
    name: "HeaderPushComponent",
    computed: {
        ...mapState({
            sites: state => state.sites
        }),
        ...mapGetters("sites", {
            sites: "getSites"
        }),
    },
    mounted() {
        this.$store.dispatch("sites/FETCH_SITES");
    }
}
</script>

<style scoped>

</style>
