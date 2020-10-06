<template>
    <div class="blocker current">
        <div id="enter" class="modal" style="display: inline-block;">
            <h2>{{ $t('Вход') }}</h2>
            <form :action="action" method="POST" @submit.prevent="submit">
                <div class="modal__inner">
                    <input type="email" v-model="email" name="email" placeholder="E-mail" required>
                    <input type="password" v-model="password" name="password" :placeholder="$t('Пароль')" required>
                    <button type="submit" class="header-landing__wrapper__links_reg">
                        {{ $t('Войти') }}
                    </button>
                </div>
            </form>
            <a href="#close-modal" @click.prevent="$emit('close')" class="close-modal">Close</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    props: {
        action: {
            type: String,
            default: '/login'
        },
    },
    data() {
        return {
            email: '',
            password: ''
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
