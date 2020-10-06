<template>
    <div class="section3__form">
        <form :action="action" method="post" @submit.prevent="submit">
            <input type="email" v-model="email" name="email" :placeholder="$t('Введите e-mail')">
            <button type="submit">
                {{ $t('Попробовать') }}
            </button>
        </form>
    </div>
</template>

<script>
import RegisterModal from "../UI/Modals/Register";

export default {
    name: "RegisterNow",
    props: {
        action: {
            type: String,
            default: '/register'
        },
    },
    data() {
        return {
            email: '',
        }
    },
    methods: {
        submit() {
            this.$modal.show(
                RegisterModal,
                {
                    action: this.action,
                    now_email: this.email
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
