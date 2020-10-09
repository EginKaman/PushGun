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
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
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
                    this.swal("Your imaginary file is safe!");
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
