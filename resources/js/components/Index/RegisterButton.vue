<template>
    <a href="#register" class="header-landing__wrapper__links_reg" @click.prevent="show">{{ $t('Регистрация') }}</a>
</template>

<script>
import RegisterModal from "../UI/Modals/Register";

export default {
    name: "RegisterButton",
    props: {
        action: {
            type: String,
            default: '/login'
        },
    },
    methods: {
        show() {
            this.$modal.show(
                RegisterModal,
                {
                    action: this.action
                },
                {
                    height: 'auto',
                    width: '500px'
                },
                {}
            )
        }
    }
}
</script>

<style scoped>

</style>
