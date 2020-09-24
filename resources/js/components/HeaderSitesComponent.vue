<template>
    <div class="nav__menu">
        <ul class="nav__menu_inner">
            <li class="nav__menu_item" v-for="site in sites">
                <a class="nav__menu_link" :href="site.url">{{ site.link }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "HeaderSitesComponent",
    data() {
        return {
            sites: []
        }
    },
    async mounted() {
        await axios.get('/site').then(({data}) => {
            this.sites = data.data;
        });
    }
}
</script>

<style scoped>

</style>
