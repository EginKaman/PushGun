<template>
    <main>
        <div class="email-push-show__tabs">
            <a @click="show = 1" :class="{ active: show === 1 }"
                >Адреса отправителя</a
            >
            <a @click="show = 2" :class="{ active: show === 2 }"
                >Аутентификация</a
            >
        </div>
        <div class="create-mail" style="margin-bottom: 15px">
            <div class="button_green mr-24">
                <span
                    class="green_button_circle desplode-circle"
                    style="left: 179px; top: 49px"
                ></span>
                <a @click="showPopup = true" href="#" class="button_green_inner"
                    ><img
                        src="http://www.pushgun.ru/images/zavitok.svg"
                        alt=""
                    />
                    <p class="button_text_container">
                        Новый адрес отправителя
                    </p></a
                >
            </div>
            <div class="button_green mr-24">
                <span
                    class="green_button_circle desplode-circle"
                    style="left: 51px; top: 43.125px"
                ></span>
                <a href="#" class="button_green_inner"
                    ><img
                        src="http://www.pushgun.ru/images/telephoune.svg"
                        alt=""
                    />
                    <p class="button_text_container">Имя отправителя смс</p></a
                >
            </div>
        </div>
        <div v-if="show === 1" class="contact-table">
            <div
                style="
          display: flex;
          justify-content: space-between;
          align-items: center;
        "
            >
                <div
                    id="filter"
                    style="margin-bottom: 15px"
                    class="button_green"
                >
                    <span
                        class="green_button_circle desplode-circle"
                        style="left: 102px; top: 31px"
                    ></span>
                </div>
                <a class="contact-table__btn pointer" :href="route('emailSender.export')">Экспорт</a>
            </div>
            <div class="contact-table__wrapper">
                <div class="contact-table__wrapper head">
                    <ul style="grid-template-columns: 1fr 1fr 1fr 0.1fr">
                        <li>Email адрес</li>
                        <li>Имя</li>
                        <li>Состояние</li>
                        <li></li>
                    </ul>
                </div>
                <div
                    v-for="(sender, index) in senders"
                    :key="index"
                    class="contact-table__wrapper"
                >
                    <ul
                        style="grid-template-columns: 1fr 1fr 1fr 0.1fr"
                        class="statuses-color"
                    >
                        <li>
                            <span>Email адрес:</span>
                            <p>{{ sender.address }}</p>
                        </li>
                        <li>
                            <span>Имя:</span>
                            <p>{{ sender.name }}</p>
                        </li>
                        <li
                            class="green-color"
                            :class="{ red: sender.status === 1 }"
                        >
                            <span>Состояние:</span>
                            <p>Активно</p>
                        </li>
                        <li>
                            <!-- <span>Устройство/Браузер:</span> -->
                            <p @click="func(sender.id)">...</p>
                        </li>
                    </ul>
                    <div
                        v-if="showModal === sender.id"
                        class="contact-table__modal"
                    >
                        <div
                            @click="showModal = null"
                            class="contact-table__modal__close"
                        >
                            x
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="contact-table__pagination">
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
                <img src="../../images/right.svg" />
            </div> -->
        </div>
        <form v-if="show === 2">
            <div class="authentic-block">
                <p>
                    По умолчанию, ваши email-сообщения подписаны цифровыми
                    подписями SendPulse. Это помогает обеспечивать высокий
                    уровень доставки и при этом не требует от вас умения
                    редактировать DNS-записи. Тем не менее, мы рекомендуем
                    настроить собственные SPF и DKIM записи.
                </p>
                <div class="authentic-block__item">
                    <div>
                        <h3>Аутентификация(SPF и DKIM записи)</h3>
                        <p>
                            Добавьте SPF и DKIM записи для своего домена. Это
                            может улучшить доставляемость рссылок.
                        </p>
                    </div>
                    <div class="authentic-block__item__domain">
                        <p>домен.ру</p>
                        <span>Ожидает подтверждения <a>Отключить</a></span>
                    </div>
                </div>
                <div class="authentic-block__input">
                    <p>Имя домена отправки</p>
                    <input type="text" placeholder="https://example.com" />
                    <button>Получить SPF И DKIM записи</button>
                    <a>Скрыть настройки для домен.ру</a>
                </div>
                <div class="authentic-block__alert">
                    <span></span>
                    <p>
                        Важно! Вы должны добавить следующие записи в панели
                        управления вашего хостинга<br />
                        как создать текстовую запись вы можете прочитать
                        <a>здесь</a><br />
                        Обновление DNS может занимать до 24 часов
                    </p>
                </div>
                <div class="authentic-block__info">
                    <p>
                        Пропишите DKIM запись
                        <span>sign_domainkey.beribiletik.ru,</span> тип
                        <span>TXT,</span> значение:
                    </p>
                    <input
                        readonly
                        :value="
                            'v=DKIM1; k=rsa; p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCx4Nb1V6Tt1ya42eHvGjG03nDiSBH3/riCS8yDKjo4hCdii/5i5NoNBWX7OeoJwP9VgdeyKJM0KUyfPt7GJXQ3LhHnKbZ0enk+oo6Japr9D1uG12n/Zify5IS8GYmJsgXzN2YrDH2SOmoeU5TXArWphjSU9u8BQ0d4LjdR8feluQIDAQAB'
                        "
                        type="text"
                    />
                </div>
                <div class="authentic-block__info">
                    <p>
                        Пропишите SPF запись <span>beribiletik.ru,</span> тип
                        <span>TXT,</span> значение:
                    </p>
                    <input
                        readonly
                        :value="
                            'v=spf1 include:_spf.timeweb.ru include:mxsspf.sendpulse.com ~all'
                        "
                        type="text"
                    />
                </div>
                <button>Проверить DNS записи</button>
            </div>
            <div class="authentic-block">
                <div class="authentic-block__item">
                    <div>
                        <h3>Политика DMARC</h3>
                        <p>
                            Настройте политику <a>DMARC</a>, чтобы уменьшить
                            вероятность отправки фишинговых писем со своего
                            домена. Обязательно нужно настроить для отправки AMP
                            писем.
                        </p>
                    </div>
                </div>
                <div class="authentic-block__input">
                    <a>Скрыть настройки для домен.ру</a>
                </div>
                <div class="authentic-block__info">
                    <p>
                        Пропишите DMARC запись
                        <span>_dmarc.beribiletik.ru,</span> тип
                        <span>TXT,</span> значение:
                    </p>
                    <input
                        readonly
                        :value="'v=DMARC1; p=quarantine;'"
                        type="text"
                    />
                </div>
                <button>Проверить DNS записи</button>
            </div>
            <div class="authentic-block">
                <div class="authentic-block__item">
                    <div>
                        <h3>Свой домен для отслеживания</h3>
                        <p>
                            Используйте собственный домен для отслеживания
                            переходовы по ссылкам.
                        </p>
                    </div>
                </div>
                <button>Подключить</button>
            </div>
        </form>
        <div v-if="showPopup === true" class="contact-popup">
            <div v-click-outside="closePopup" class="contact-popup__block">
                <div
                    @click="showPopup = false"
                    class="contact-popup__block__head"
                >
                    <p>Новая адрес отправителя</p>
                    <img src="../../images/business-close.svg" alt="" />
                </div>
                <div class="contact-popup__block__sect">
                    <p>Email адрес отправителя:<span>*</span></p>
                    <input
                        type="text"
                        placeholder="Значение"
                        v-model="form.address"
                    />
                    <p style="margin-top: 10px">
                        Имя отправителя:<span>*</span>
                    </p>
                    <input
                        type="text"
                        placeholder="Значение"
                        v-model="form.name"
                    />
                    <p style="margin-top: 10px">
                        Домен отправителя:<span></span>
                    </p>
                    <input
                        type="text"
                        placeholder="Значение"
                        v-model="form.domain"
                    />
                </div>
                <div class="contact-popup__block__foot">
                    <div class="button_green mr-24">
                        <span class="green_button_circle"></span>
                        <a
                            class="button_green_inner"
                            @click="createEmailSender"
                        >
                            <p class="button_text_container">
                                <img src="" alt="" />Добавить
                            </p>
                        </a>
                    </div>
                    <div style="backgorund: #fafafa" class="button_white">
                        <span class="white_button_circle"></span>
                        <a
                            @click="showPopup = false"
                            style="background: rgb(222 222 222 / 1)"
                            class="button_white_inner"
                        >
                            <p class="button_text_container">
                                <img class="button-img" src="" alt="" />Отмена
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import vClickOutside from "v-click-outside";
import axios from "axios";
export default {
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: ["emailsenders"],
    data: () => ({
        showPopup: false,
        showModal: null,
        show: 1,
        form: {
            name: "",
            address: "",
            domain: null
        },
        senders: []
    }),
    methods: {
        func(item) {
            this.showModal = item;
        },
        closePopup() {
            this.showPopup = false;
        },
        isEmail(emailAddress) {
            const pattern = new RegExp(
                /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
            );

            return pattern.test(emailAddress);
        },
        createEmailSender() {
            if (!this.isEmail(this.form.address)) {
                return;
            }
            axios.post(route("emailSender.store"), this.form).then(res => {
                if (res.status === 201) {
                    this.senders.push(res.data.emailSender);
                    this.closePopup();
                }
            });
        }
    },
    mounted() {
        this.senders = this.emailsenders;
    }
};
</script>
