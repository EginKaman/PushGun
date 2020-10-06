<template>
    <div class="blocker current">
        <div id="register" class="modal" style="display: inline-block;">
            <h2>{{ $t('Регистрация') }}</h2>
            <form :action="action" method="POST" @submit.prevent="submit">
                <div class="modal__inner">
                    <input type="text" v-model="name" name="name" :placeholder="$t('Имя') + '*'">
                    <input type="email" v-model="email" name="email" placeholder="E-mail*" required>
                    <input type="password" v-model="password" name="password" :placeholder="$t('Пароль') + '*'"
                           required>
                    <input type="password" v-model="password_confirmation" name="password_confirmation"
                           :placeholder="$t('Повторите пароль') + '*'"
                           required>
                    <button type="submit" class="header-landing__wrapper__links_reg">{{ $t('Зарегистрироваться') }}
                    </button>
                </div>
            </form>
            <a href="#close-modal" @click.prevent="$emit('close')" class="close-modal">Close</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    props: {
        action: {
            type: String,
            default: '/register'
        },
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },
    methods: {
        submit() {
            axios.post(this.action, {
                email: this.email,
                password: this.password
            }).then(response => {
                location.reload();
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
