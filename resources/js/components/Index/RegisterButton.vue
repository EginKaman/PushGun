<template>
    <a href="#register" :class="classes" @click.prevent="show">{{ $t('Регистрация') }}</a>
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
        classes: {
            type: String,
            default: '/login'
        },
        referrer: {
            default: null
        }
    },
    methods: {
        show() {
            this.$modal.show(
                RegisterModal,
                {
                    action: this.action,
                    referrer: this.referrer
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
