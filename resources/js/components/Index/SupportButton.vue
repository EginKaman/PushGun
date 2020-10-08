<template>
    <a href="#support" @click.prevent="show">{{ $t('Связаться с Техподдержкой') }}</a>
</template>

<script>
import SupportModal from "../UI/Modals/Support";

export default {
    name: "SupportButton",
    props: {
        action: {
            type: String,
            default: '/support'
        },
    },
    methods: {
        show() {
            this.$modal.show(
                SupportModal,
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
