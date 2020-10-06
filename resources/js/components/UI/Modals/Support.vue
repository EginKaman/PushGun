<template>
    <div class="blocker current">
        <div id="support" class="modal" style="display: inline-block;">
            <h2>{{ $t('Связаться с Техподдержкой') }}</h2>
            <form :action="action" method="POST" @submit.prevent="submit">
                <div class="modal__inner">
                    <input type="text" v-model="name" name="name" :placeholder="$t('Имя')">
                    <input type="email" v-model="email" name="email" placeholder="E-mail*" required>
                    <textarea cols="2" v-model="message" name="message" rows="2"
                              :placeholder="$t('Введите ваше сообщение') + '*'"
                              required></textarea>
                    <button type="submit" class="header-landing__wrapper__links_reg">{{ $t('Отправить') }}</button>
                </div>
            </form>
            <a href="#close-modal" @click.prevent="$emit('close')" class="close-modal">Close</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Support",
    props: {
        action: {
            type: String,
            default: '/support'
        },
    },
    data() {
        return {
            name: '',
            email: '',
            message: ''
        }
    },
    methods: {
        submit() {
            axios.post(this.action, {
                email: this.email,
                name: this.name,
                message: this.message
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
