<template>
    <div class="section7__form">
        <form :action="action" method="post" @submit.prevent="submit">
            <div class="section7__form__row">
                <input type="text" v-model="name" name="name" class="section7__form__name"
                       :placeholder="$t('Ваше имя')">
                <input type="email" v-model="email" name="email" class="section7__form__email" placeholder="E-mail">
            </div>
            <input type="text" v-model="message" name="message" class="section7__form__text"
                   :placeholder="$t('Ваше сообщение')">
            <p class="section7__form__chk">
                <input type="checkbox" v-model="accepted" name="accepted" value="1">
                {{
                    $t('Я даю согласие на обработку персональных данных в соответствии с законом № 152-ФЗ «О персональных данных»')
                }}
            </p>
            <button type="submit" class="section7__form__btn">{{ $t('Отправить') }}</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Question",
    props: {
        action: {
            type: String,
            default: '/question'
        },
    },
    data() {
        return {
            name: '',
            email: '',
            message: '',
            accepted: false
        }
    },
    methods: {
        submit() {
            axios.post(this.action, {
                email: this.email,
                name: this.name,
                message: this.message,
                accepted: this.accepted
            }).then(response => {
                this.$swal({
                    title: this.$i18n.t('Успех!'),
                    text: response.data.message,
                    icon: "success",
                });
            }).catch(error => {
                let errors = '';
                if (error.response.status === 403) {
                    errors = error.response.statusText;
                } else {
                    errors = Object.values(error.response.data.errors);
                    errors = errors.flat().join("\r\n")
                }
                this.$swal({
                    title: this.$i18n.t('Ошибка!'),
                    text: errors,
                    icon: "error",
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
