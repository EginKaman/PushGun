<template>
    <a href="#enter" :class="classes" @click.prevent="show">{{ $t('Войти') }}</a>
</template>

<script>
import LoginModal from '../UI/Modals/Login'

export default {
    name: "LoginButton",
    props: {
        action: {
            type: String,
            default: '/login'
        },
        classes: {
            type: String,
            default: '/login'
        }
    },
    methods: {
        show() {
            this.$modal.show(
                LoginModal,
                {
                    action: this.action
                },
                {
                    height: 'auto',
                    width: '500px'
                },
                {

                }
            )
        }
    }
}
</script>

<style scoped>

</style>
