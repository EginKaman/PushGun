<template>
    <div class="nav__menu">
        <ul class="nav__menu_inner">
            <li class="nav__menu_items one" >
                <a class="nav__menu_link" href="/account">{{ $t('Все рассылки') }}</a>
            </li>
            <li class="nav__menu_items two" >
                <a class="nav__menu_link" href="/account/autoMailing">{{ $t('Авторассылки') }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapGetters, mapState} from "vuex";

    export default {
        name: "HeaderSitesComponent",
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
