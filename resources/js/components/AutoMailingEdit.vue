<template>
    <form
        :actions="action"
        enctype="multipart/form-data"
        method="POST"
        @submit.prevent
        class="automailings__form"
    >
        <div class="general__title">
            <div class="title">
                Редактирование авторассылки
            </div>
        </div>
        <div class="createmailing__wrapper">
            <div class="createmailing__wrapper__item">
                <label
                    ><span>Название рассылки:</span>
                    <input
                        type="text"
                        name="name"
                        v-model="form.name"
                        placeholder="Введите название рассылки"
                /></label>
            </div>
            <!--  -->
            <vSelect
                v-if="sites.length"
                mode="Multiple"
                :data="sites"
                optionName="link"
                keyName="id"
                :additionalOptionName="{
                    isShow: true,
                    optionName: 'push_subscriptions_count',
                    label: 'Подписчиков'
                }"
                :label="{
                    position: 'left',
                    show: true,
                    text: 'Условие отправки'
                }"
                :defaultValue="{
                    isActive: true,
                    keys: Object.values(form.sites)
                }"
                @selected="sites => (form.sites = sites)"
                :resetOption="{
                    isShow: true,
                    text: 'Сбросить',
                    isSendRequestAfterReset: false
                }"
            />
            <div class="createmailing__wrapper__item">
                <div class="createmailing__wrapper__item__checkbox">
                    <label class="trc">
                        <span>Дни отправки:</span>
                    </label>
                    <div class="createmailing__wrapper__item__input">
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="monday"
                            /><br /><span>Пн</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="tuesday"
                            /><br /><span>Вт</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="wednesday"
                            /><br /><span>Ср</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="thursday"
                            /><br /><span>Чт</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="friday"
                            /><br /><span>Пт</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="saturday"
                            /><br /><span>Сб</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                v-model="form.days"
                                value="sunday"
                            /><br /><span>Вс</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="createmailing__wrapper__item">
                <div class="createmailing__wrapper__item__checkbox">
                    <label>
                        <span>Вреия отправки:</span>
                    </label>
                    <div class="createmailing__wrapper__item__input trl">
                        <input
                            class="time"
                            min="0"
                            v-model="form.time.hours"
                            max="23"
                            v-mask="'##'"
                            type="number"
                        />
                        <span>:</span>
                        <input
                            class="time"
                            min="0"
                            v-model="form.time.minute"
                            max="59"
                            type="number"
                        />
                    </div>
                </div>
            </div>
            <div class="createmailing__wrapper__center">
                <div class="createmailing__wrapper__item__checkbox">
                    <div class="createmailing__wrapper__item__input">
                        <div>
                            <input
                                type="checkbox"
                                v-model="isShowMarkInputs"
                            /><br /><span
                                >Добавить метки для Google Analytics и Яндекс
                                метрики</span
                            >
                        </div>
                    </div>
                </div>
                <div class="createmailing__wrapper__item"></div>
                <div
                    class="createmailing__wrapper__item"
                    v-if="isShowMarkInputs"
                >
                    <label
                        ><span>Источник компании (utm_source)</span>
                        <input
                            type="text"
                            v-model="form.marks.utm_source"
                            placeholder="pushgun"
                    /></label>
                    <label
                        ><span>Канал компании (utm_medium)</span>
                        <input
                            type="text"
                            v-model="form.marks.utm_medium"
                            placeholder="webpush"
                    /></label>
                    <label
                        ><span>Название компании (utm_compaign)</span>
                        <input
                            type="text"
                            v-model="form.marks.utm_compaign"
                            placeholder="compaign_id"
                    /></label>
                    <p>
                        Используйте compaign_id для автоматической подстановки
                        id push-рассылки
                    </p>
                </div>
            </div>
        </div>
        <div class="contains" v-for="(push, index) in form.pushes" :key="index">
            <div class="left__item__block">
                <div class="left__item__content">
                    <span class="oval">{{ index + 1 }}</span>
                    <span class="polosa"></span>
                    <span class="oval">+</span>
                </div>
            </div>
            <div class="createmailing__wrapper__two">
                <div class="createmailing__wrapper__two__head">
                    <p>Отправить push</p>
                    <!-- <div class="createmailing__select_delayMode">
                        <p>
                            Через<span class="material-icons"
                                >keyboard_arrow_down</span
                            >
                        </p>
                        <ul>
                            <li @click="toggleInputVisibilityToSelectDelay(index)">Сразу</li>
                        </ul>
                    </div> -->
                    <vSelect
                        v-if="delayModes"
                        mode="Single"
                        :data="delayModes"
                        optionName="text"
                        :defaultValue="{
                            isActive: true,
                            key: 1
                        }"
                        keyName="id"
                        :isShowCheckbox="false"
                        class="selectModeDelay"
                        :maxWidth="{
                            size: 200,
                            unit: 'px'
                        }"
                        @selected="mode => (push.delay.mode = mode)"
                    />
                    <div class="createmailing__wrapper__item">
                        <div class="createmailing__wrapper__item__checkbox">
                            <div
                                class="createmailing__wrapper__item__input trl"
                            >
                                <input
                                    class="min"
                                    name="delayNotify"
                                    min="0"
                                    max="23"
                                    value="0"
                                    v-model="push.delay.value"
                                    type="number"
                                    placeholder="0"
                                />
                                <vSelect
                                    v-if="times.length"
                                    mode="Single"
                                    :data="times"
                                    :translate="{
                                        use: true,
                                        lang: 'ru'
                                    }"
                                    optionName="title"
                                    :defaultValue="{
                                        isActive: true,
                                        key: push.delay.time
                                    }"
                                    keyName="id"
                                    :isShowIcon="false"
                                    :isShowCheckbox="false"
                                    class="selectTimeClass"
                                    :maxWidth="{
                                        size: 120,
                                        unit: 'px'
                                    }"
                                    @selected="time => (push.delay.time = time)"
                                />
                            </div>
                        </div>
                        <span>
                            {{
                                index > 0
                                    ? "После отправки предыдущего сообщения"
                                    : "После подписки"
                            }}
                        </span>
                    </div>
                    <div class="deletePush" v-if="index > 0">
                        <span
                            class="material-icons pointer"
                            @click="deletePush(index)"
                            >close</span
                        >
                    </div>
                </div>
                <div class="createmailing__wrapper__two__content">
                    <div class="createmailing__wrapper__item">
                        <label
                            ><span class="ttl">Заголовок</span>
                            <input
                                type="text"
                                name="title"
                                v-model="push.title"
                                placeholder="до 50 символов"
                        /></label>
                        <p
                            class="input_validation_text"
                            v-if="push.title.length > 50"
                        >
                            Превышения рекомендованной длины сообщения в 50
                            символов
                        </p>
                        <label
                            ><span class="ttl">Текст уведомления</span>
                            <textarea
                                type="text"
                                v-model="push.text"
                                name="text"
                            ></textarea
                        ></label>
                        <p
                            class="input_validation_text"
                            v-if="push.text.length > 125"
                        >
                            Превышения рекомендованной длины сообщения в 125
                            символов
                        </p>
                        <label>
                            <span class="ttl">Ссылка на уведомление</span>
                            <input
                                type="text"
                                name="link"
                                v-model="push.link"
                                value=""
                            />
                        </label>
                        <div class="createmailing__wrapper__item__checkbox">
                            <div class="createmailing__wrapper__item__input">
                                <div>
                                    <input
                                        type="checkbox"
                                        v-model="push.showImageBlock"
                                    /><br /><span style="color: 000;"
                                        >Заменить стандартную картинку
                                        сайта</span
                                    >
                                </div>
                            </div>
                        </div>
                        <label class="image__site" v-show="push.showImageBlock">
                            <span class="ttl">Изображение сайта</span>
                            <div class="image__site__block">
                                <img :src="push.previewImage" alt="" />
                                <label class="file">
                                    Выбрать изображение
                                    <input
                                        type="file"
                                        ref="imagePush"
                                        name="image"
                                        @change="uploadPushImage(index)"
                                    />
                                    <span
                                        >Рекомендуемый размер: 128*128px <br />
                                        JPG, PNG до 200KB
                                    </span>
                                </label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="save-block">
                <a
                    class="button-create"
                    @click="createBlockForNewPush"
                    v-if="form.pushes.length === index + 1"
                    >Новое уведомление</a
                >
            </div>
        </div>
        <div class="createmailing-foot">
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <button type="submit" class="button_green_inner">
                    <button
                        @click="submit('active')"
                        class="button_text_container"
                    >
                        Сохранить
                    </button>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import vClickOutside from "v-click-outside";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import axios from "axios";
export default {
    name: "AutoMailingEdit",
    data: () => ({
        delayModes: [
            {
                text: "Через",
                id: 1
            },
            {
                text: "Сразу",
                id: 2
            }
        ],
        defaultImage: "../../images/site.svg",
        pushNumber: 0,
        form: {
            name: "",
            sites: [],
            days: [],
            time: {
                hours: "00",
                minute: "00"
            },
            marks: {
                utm_source: "",
                utm_medium: "",
                utm_compaign: ""
            },
            pushes: []
        },

        selectedSites: null,
        isShowMarkInputs: false
    }),
    directives: {
        clickOutside: vClickOutside.directive
    },
    validations: {
        form: {
            name: {
                required
            },
            time: {
                hours: {
                    required
                },
                minute: {
                    required
                }
            },
            pushes: {
                $each: {
                    title: {
                        required,
                        maxLength: maxLength(50)
                    },
                    text: {
                        required,
                        maxLength: maxLength(125)
                    },
                    link: {
                        required
                    }
                }
            }
        }
    },
    props: {
        action: {
            type: String,
            default: ""
        },
        automailing: {
            default: null
        }
    },
    methods: {
        submit(status = "active") {
            this.$v.form.$touch();
            if (this.$v.form.$invalid) {
                alert("заполните");
                return;
            }
            const s = this.statuses.find(item => item.title === status);
            const form = new FormData();
            form.append("name", this.form.name);
            form.append("hours", this.form.time.hours);
            form.append("minute", this.form.time.minute);
            form.append("status_id", Number(s.id));
            form.append("utm_source", this.form.marks.utm_source);
            form.append("utm_medium", this.form.marks.utm_medium);
            form.append("utm_compaign", this.form.marks.utm_compaign);
            this.form.sites.forEach(site => {
                form.append("sites[]", site);
            });
            this.form.days.forEach(day => {
                form.append("days[]", day);
            });
            this.form.pushes.forEach((push, index) => {
                console.log(index);
                form.append(`pushes[${index}][title]`, push.title);
                form.append(`pushes[${index}][text]`, push.text);
                form.append(`pushes[${index}][link]`, push.link);
                form.append(`pushes[${index}][delay][time]`, push.delay.time);
                form.append(`pushes[${index}][delay][value]`, push.delay.value);
                form.append(`pushes[${index}][id]`, push.id);
                form.append(
                    `pushes[${index}][delay][previousPush]`,
                    push.delay.previousPush
                );
                form.append(
                    `pushes[${index}][image]`,
                    this.$refs.imagePush[index].files[0] || ""
                );
                form.append(`pushes[${index}][icon]`, "");
            });
            axios.post(route("autoMailing.update", this.automailing), form, {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "Cache-Control": "no-cache"
                }
            }).then(res=>{
                if(res.status === 201) {
                    window.location.replace(route('account.automailing'))
                }
            });
        },
        deletePush(index) {
            this.form.pushes.splice(index, 1);
        },
        uploadPushImage(index) {
            const file = event.target.files.item(0);
            this.form.pushes[index].image = file;
            const reader = new FileReader();
            reader.addEventListener("load", e => {
                this.form.pushes[index].previewImage = e.target.result;
            });
            reader.readAsDataURL(file);
        },
        createBlockForNewPush(index) {
            this.form.pushes.push({
                id: null,
                delay: {
                    time: 1,
                    value: 0,
                    previousPush: "",
                    isNow: false
                },
                title: "",
                text: "",
                link: "",
                image: null,
                icon: null,
                previewImage: this.defaultImage
            });
        }
    },
    components: {},
    watch: {
        isShowMarkInputs() {
            if (this.isShowMarkInputs === false) {
                this.form.marks = {
                    utm_source: "",
                    utm_medium: "",
                    utm_compaign: ""
                };
            }
        }
    },
    computed: {
        ...mapState({
            sites: state => state.sites.sites,
            times: state => state.times.times,
            statuses: state => state.state.automailingStatuses.statuses
        }),
        ...mapGetters("sites", {
            sites: "getSites",
            times: "getTimes"
        }),
        sites: {
            get() {
                return this.$store.state.sites.sites;
            }
        },
        times: {
            get() {
                return this.$store.state.times.times;
            }
        },
        statuses: {
            get() {
                return this.$store.state.automailingStatuses.statuses;
            }
        }
    },
    mounted() {
        this.$store.dispatch("sites/FETCH_SITES");
        this.$store.dispatch("times/FETCH_TIMES");
        this.$store.dispatch("automailingStatuses/FETCH_AUTOMAILING_STATUSES");
        // set default value to form
        this.form.name = this.automailing.name;
        this.automailing.sites.forEach(site => this.form.sites.push(site.id));
        if (this.automailing.monday === true) this.form.days.push("monday");
        if (this.automailing.tuesday === true) this.form.days.push("tuesday");
        if (this.automailing.wednesday === true)
            this.form.days.push("wednesday");
        if (this.automailing.thursday === true) this.form.days.push("thursday");
        if (this.automailing.friday === true) this.form.days.push("friday");
        if (this.automailing.saturday === true) this.form.days.push("saturday");
        if (this.automailing.sunday === true) this.form.days.push("sunday");
        const time = this.automailing.time.split(":");
        this.form.time.hours = time[0];
        this.form.time.minute = time[1];
        this.automailing.pushes.forEach(push => {
            this.form.pushes.push({
                id: push.id,
                delay: {
                    time: push.time_id,
                    value: push.delay,
                    mode: 1,
                    previousPush: ""
                },
                title: push.title,
                text: push.text,
                link: push.link,
                image: push.image,
                showImageBlock: push.image ? true : false,
                icon: push.icon,
                previewImage: push.image || "../../images/site.svg"
            });
        });
    }
};
</script>

<style lang="scss" scoped></style>
