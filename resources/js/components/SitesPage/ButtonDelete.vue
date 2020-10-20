<template>
    <a :href="action" :class="buttonClass" @click.prevent="destroy">{{ $t('Удалить сайт') }}</a>
</template>

<script>
export default {
    name: "ButtonDelete",
    props: {
        action: {
            type: String,
            default: ''
        },
        buttonClass: {
            type: String,
            default: ''
        }
    },
    methods: {
        destroy() {
            this.$swal({
                title: this.$i18n.t("Are you sure?"),
                text: this.$i18n.t("Once deleted, you will not be able to recover this site!"),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios.delete(this.action)
                        .then((response) => {
                            this.success();
                        });
                } else {
                    this.swal("Your site is safe!");
                }
            });
        },
        success() {
            this.$swal({
                title: this.$i18n.t('Успех!'),
                text: this.$i18n.t('Сайт удален успешно'),
                icon: "success",
            }).then(() => {
                location.reload();
            });
        }
    }
}
</script>

<style scoped>

</style>
