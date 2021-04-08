<template>
   <div class="contact-popup">
            <div v-click-outside="close" class="contact-popup__block">
                <div @click="show = false" class="contact-popup__block__head">
                    <p>Новая адресная книга</p>
                    <img @click="close" src="/images/business-close.svg" alt="" />
                </div>
                <form
                    :action="this.action"
                    @submit.prevent="submit"
                    method="POST"
                >
                    <div class="contact-popup__block__sect">
                        <p>Введите название</p>
                        <input
                            type="text"
                            v-model="form.name"
                            placeholder="Новый список 18"
                        />
                    </div>
                    <div class="contact-popup__block__foot">
                        <div class="button_green mr-24">
                            <span class="green_button_circle"></span>
                            <button class="button_green_inner">
                                <p class="button_text_container">
                                    <img src="" alt="" />Добавить
                                </p>
                            </button>
                        </div>
                        <div style="backgorund: #fafafa" class="button_white" @click="close">
                            <span class="white_button_circle"></span>
                            <a
                                style="background: rgb(222 222 222 / 1)"
                                class="button_white_inner"
                                @click="close"
                            >
                                <p class="button_text_container">
                                    <img
                                        class="button-img"
                                        src=""
                                        alt=""
                                    />Отмена
                                </p>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
import vClickOutside from "v-click-outside";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import axios from "axios";
export default {
    name: 'NewAddressBook',
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: {
        action: {
            type: String,
            required: true
        }
    },
    validations: {
        form: {
            name: {
                required,
                minLength: minLength(5)
            }
        }
    },
    data: () => ({
        form: {
            name: ""
        }
    }),
    methods: {
        close() {
            this.$emit('close')
        },
        submit() {
            this.$v.form.$touch();
            if (this.$v.form.$invalid) {
                return;
            }
            axios.post(this.action, this.form)
            .then(res => {
              if(res.status === 200) {
                window.location.replace(route('addressbook.create', res.data.id))
              }
            })
        }
    }
};
</script>

<style lang="scss" scoped>

</style>