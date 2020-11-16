<template>
    <div class="inner">
        <div class="push__settings">
            <form :action="action" method="POST" enctype="multipart/form-data" @submit.prevent="save">
                <div class="push__input">
                    <label for="site">{{ $t('Список получателей') }}</label>
                    <select id="site" class="filter__input filter__selector" v-model="site_id" name="site"
                            @change="siteSelect">
                        <option :value="site.id" v-for="(site, index) in sites" :key="index">{{ site.link }}</option>
                    </select>
                </div>
                <div class="push__input">
                    <label for="title">{{ $t('Заголовок') }}</label>
                    <input class="inputTitle" maxlength="30" name="title" type="text"
                           v-model="title"
                           id="title"
                           :placeholder="$t('до 30 символов')">
                </div>
                <div class="push__input">
                    <label for="text">{{ $t('Текст уведомления') }}</label>
                    <textarea class="textarea" id="text" v-model="text" name="text" maxlength="130" cols="5"
                              rows="5" :placeholder="$t('до 130 символов')"></textarea>
                </div>
                <div class="push__input">
                    <label for="link">{{ $t('Ссылка на уведомление') }}</label>
                    <input type="text" id="link" v-model="link" name="link" placeholder="https://example.com">
                </div>
                <div class="agree">
                    <input type="checkbox" v-model="change" name="change" id="changeIcon">
                    <label for="changeIcon">{{ $t('Заменить стандартную картинку сайта') }}</label>
                    <a href="/tariff" class="tarrifs">Купите тариф PRO, что-бы удалить логотип "Предоставлено Push.Gun"</a>
                    <div class="site_set_avatar" id="site_set_avatar" v-show="change">
                        <input type="file" ref="image" name="image" id="siteimage" accept="image/*"
                               @change="uploadImage">
                        <div class="site_set_avatar_title">{{ $t('Картинка уведомления') }}</div>
                        <label for="siteimage" class="site_avatar_form">
                            <img :src="selected.image || default_image" alt="" id="image">
                            <div class="site_avatar_form_block">
                                <p class="site_avatar_form_title">
                                    {{ $t('Выберите изображение') }}
                                </p>
                                <p class="site_avatar_form_desc">
                                    {{ $t('Рекомендуемый размер: 128×128px JPG, svg до 200KB') }}
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="big_image">
                    <div class="site_set_avatar">
                        <input type="file" ref="bigImage" name="bigImage" id="siteBigImage" accept="image/*" @change="uploadBigImage">
                        <div class="site_set_avatar_title">{{ $t('Добавить большое изображение') }}</div>
                        <label for="siteBigImage" class="site_avatar_form">
                            <img :src="big_image || default_image" alt="">
                            <div class="site_avatar_form_block">
                                <p class="site_avatar_form_title">
                                    {{ $t('Выберите изображение') }}
                                </p>
                                <p class="site_avatar_form_desc">
                                    {{ $t('Рекомендуемый размер: 400x200px JPG, PNG до 200KB') }}
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="bottom">
                    <div class="bottom_inner">
                        <div class="button_green mr-24">
                            <span class="green_button_circle">
                            </span>
                            <button type="submit" class="button_green_inner">
                                <p class="button_text_container">{{ $t('Отправить') }}</p>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="push__test">
            <div class="block">
                <p>Chrome, Windows</p>
                <div class="chrome">
                    <div class="chrome__large" v-if="big_image"><img :src="big_image" alt=""></div>
                    <div class="chrome__block">
                        <div class="chrome__small"><img :src="selected.image || default_image" alt="avatar"></div>
                        <div class="chrome__text">
                            <p class="res">{{ title || $t('Заголовок') }}</p>
                            <p class="txt">{{ text || $t('Текст вашего сообщения') }}</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>Firefox, Windows</p>
                    <div class="firefox">
                        <!--                        <img src="../../images/avatar.svg" alt="avatar">-->
                        <img :src="selected.image || default_image" alt="avatar">
                        <div class="firefox__text">
                            <p class="res">{{ title || $t('Заголовок') }}</p>
                            <p class="txt">{{ text || $t('Текст вашего сообщения') }}</p>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <p>Chrome, macOS</p>
                    <div class="macos">
                        <img class="macos__avatar" src="../../images/chrome.svg" alt="chrome">
                        <div class="macos__text">
                            <p class="res">{{ title || $t('Заголовок') }}</p>
                            <p class="txt">{{ text || $t('Текст вашего сообщения') }}</p>
                        </div>
                        <img class="macos__avatar" :src="selected.image || default_image" alt="avatar">
                        <div class="macos__settings">
                            <span>{{ $t('Закрыть') }}</span>
                            <span>{{ $t('Настройки') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapState} from "vuex";

export default {
    name: "PushCreate",
    props: {
        action: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            Ssite_id: 0,
            selected: {},
            title: '',
            text: '',
            link: '',
            errors: {},
            change: false,
            default_image: '/images/site.svg',
            big_image: null,
        }
    },
    computed: {
        ...mapState({
            sites: state => state.sites.sites
        }),
        ...mapGetters("sites", {
            sites: "getSites"
        }),
        sites: {
            get() {
                return this.$store.state.sites.sites;
            },
            set(value) {
                this.$store.commit("sites/setSites", value);
            }
        },
    },
    mounted() {
        this.$store.dispatch("sites/FETCH_SITES").then(() => {
            this.selected = this.sites[0];
            this.site_id = this.selected.id;
        });
    },
    methods: {
        siteSelect(event) {
            this.selected = this.sites[event.target.selectedIndex];
        },
        uploadBigImage(event) {
            let file = event.target.files.item(0);
            let reader = new FileReader();
            this.big_image = URL.createObjectURL(file);
        },
        uploadImage(event) {
            let file = event.target.files.item(0);
            let reader = new FileReader();
            reader.addEventListener("load", this.imageLoaded);
            reader.readAsDataURL(file);
        },
        imageLoaded(event) {
            this.selected.image = event.target.result;
        },
        save() {
            let form = new FormData();
            if (this.$refs.image.files[0]) {
                form.append('icon', this.$refs.image.files[0]);
            }
            if (this.$refs.bigImage.files[0]) {
                form.append('image', this.$refs.bigImage.files[0]);
            }
            form.append('title', this.title);
            form.append('link', this.link);
            form.append('text', this.text);
            form.append('site', this.site_id);
            axios.post(this.action, form, {
                header: {
                    'Content-Type': 'multipart/form-data',
                    "Cache-Control": "no-cache"
                }
            }).then(response => {
                this.$swal({
                    title: this.$i18n.t("Успех!"),
                    text: response.data.message,
                    icon: "success",
                }).then(() => {
                    window.location.href = this.action
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

<style lang="scss" scoped>
    select {
        border: 1px solid #e5e5e5;
    }
</style>
