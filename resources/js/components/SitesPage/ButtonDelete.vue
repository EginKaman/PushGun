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
                title: this.$i18n.t("Вы уверены?"),
                text: this.$i18n.t("После удаления вы не сможете восстановить этот сайт!"),
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
                    this.swal("Ваш сайт в безопасности!");
                }
            });
        },
        success() {
            this.$swal({
                title: this.$i18n.t('Успех!'),
                text: this.$i18n.t('Сайт удален успешно'),
                icon: "success",
            }).then(() => {
                window.location = '/';
            });
        }
    }
}
</script>

<style scoped>

</style>
