<template>
    <div class="">
        <h3 class="setint__desc">{{ $t('Код PUSH.GUN для сайта') }}</h3>
        <div class="setint__info">
            <p class="setint__info_title">{{ $t('Скопируйте и вставьте код на ваш сайт, перед закрывающим тегом') }}
                <span>&lt;/head&gt;</span>
            </p>
            <pre><code>&lt;script charset="UTF-8" src="{{ script }}" async&gt;&lt;/script&gt;</code></pre>
            <div class="setint__info_checked" v-if="(checked.script || installed)">
                <img src="../../images/mark.svg" width="16" height="16" alt="V">
                <p style="color: #3B8378">{{ $t('Код добавлен корректно') }}</p>
            </div>
            <div class="setint__info_checked" v-else-if="create">
            </div>
            <div class="setint__info_checked" v-else>
                <img src="../../images/removeRed.svg" width="16" height="16" alt="X">
                <p style="color: #F33657">{{ $t('Код добавлен не корректно') }}</p>
            </div>
        </div>
        <h3 class="setint__desc">{{ $t('Установочные файлы Chrome') }}</h3>
        <div class="setint__info">
            <p class="setint__info_title">
                {{ $t("Для поддержки Chrome, загрузите установочные файлы ниже. Распакуйте из архива и скопируйте файлы в каталог верхнего уровня (root, или '/') вашего сайта.") }}
            </p>
            <div class="setint__info_download">
                <img src="../../images/download.svg" width="16" height="16" alt="">
                <a target="_blank" :href="archive">
                    {{ $t('Скачать установочные файлы') }}
                </a>
            </div>
            <div class="setint__info_checked" v-if="(checked.file || installed)">
                <img src="../../images/mark.svg" width="16" height="16" alt="V">
                <p style="color: #3B8378">{{ $t('Файл pg-push-worker.js установлен') }}</p>
            </div>
            <div class="setint__info_checked" v-else-if="create">
            </div>
            <div class="setint__info_checked" v-else>
                <img src="../../images/removeRed.svg" width="16" height="16" alt="X">
                <p style="color: #F33657">{{ $t('Файл pg-push-worker.js не установлен') }}</p>
            </div>
        </div>
        <div class="button_green save__button setint__button">
            <span class="green_button_circle"></span>
            <button type="button" class="button_green_inner" @click="check">
                <p class="button_text_container">
                    <img src="../../images/reload.svg" alt="">{{ button }}
                </p>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "SiteCheck",
    props: {
        script: {
            type: String,
            default: ''
        },
        archive: {
            type: String,
            default: ''
        },
        action: {
            type: String,
            default: ''
        },
        button: {
            type: String,
            default: ''
        },
        installed: {
            type: Boolean,
            default: false
        },
        create: {
            type: Boolean,
            default: false
        },
        recheck: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            checked: {
                script: false,
                file: false
            }
        }
    },
    methods: {
        check() {
            axios.post(this.action).then(response => {
                this.checked = response.data;
                if (this.checked) {
                    this.$swal({
                        title: this.$i18n.t('Успех!'),
                        text: `${this.$t('Код добавлен корректно')}\r\n${this.$t('Файл pg-push-worker.js установлен')}`,
                        icon: "error",
                    });
                } else {
                    this.$swal({
                        title: this.$i18n.t('Ошибка!'),
                        text: `${this.$t('Код добавлен не корректно')}\r\n${this.$t('Файл pg-push-worker.js не установлен')}`,
                        icon: "success",
                    });
                }
            });
        }
    }
}
</script>
