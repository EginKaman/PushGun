<template>
    <div class="main automailing-vue">
        <div :class="{noActive: showMenus === true}" class="button_green mr-24">
            <span class="green_button_circle"></span>
            <a @click="showMenus = true" class="button_green_inner">
                <p class="button_text_container">
                    <img src="../../images/send.svg" alt="">Создать автоматическую рассылку
                </p>
            </a>
        </div>
        <div v-if="showMenus === true" class="btn-menus">
            <a href="/account/createMailing" class="btn-menus__item">
                <div class="img-wrap">
                    <img src="../../images/sendmail.svg" alt="">
                </div>
                <div class="txt-block">
                    <p>Серия сообщений</p>
                    <span>Отправка серии сообщений после подписки на push уведомления</span>
                </div>
            </a>
            <a href="/account/createMailing" class="btn-menus__item">
                <div class="img-wrap">
                    <img src="../../images/rss.svg" alt="">
                </div>
                <div class="txt-block">
                    <p>Рассылка на основе RSS</p>
                    <span>Отправка push сообщеий после добавлеия новых записей в RSS ленте</span>
                </div>
            </a>
        </div>
        <div class="automailing__wrapper" v-for="(item, index) in mailing" :key="item.id">
            <div class="automailing__wrapper__item">
                <span @click="popupModal = index" class="popup-btn">...</span>
                <div v-if="popupModal === index" v-click-outside="popupClose" class="popup-block">
                    <a>Редактировать<img src="../../images/pan.svg" alt=""></a>
                    <a>Удалить<img src="../../images/basket.svg" alt=""></a>
                </div>
                <div class="automailing__wrapper__item__content">
                    <div class="content__wrapp">
                        <div class="content-item">
                            <p class="name">{{item.name}}</p>
                        </div>
                        <div class="content-item">
                            <span>{{item.status}}</span>
                            <a>{{item.url}}</a>
                            <div class="content-icon">
                                <div class="content-icon-item">
                                    <img src="../../images/message.svg" alt="">
                                    <p>{{item.message}}</p>
                                </div>
                                <div class="content-icon-item">
                                    <img src="../../images/calendar.svg" alt="">
                                    <p>{{item.data}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="automailing__wrapper__item__content">
                    <div class="content-item-count__wrapper">
                        <div class="content-item-count">
                            <span>{{item.usersCount}}</span>
                            <p>Подписчиков в очереди</p>
                        </div>
                        <div class="content-item-count">
                            <span>{{item.seriesCount}}</span>
                            <p>Завершенных серий</p>
                        </div>
                        <div class="content-item-count">
                            <span>{{item.pushCount}}</span>
                            <p>Отправлено push</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vClickOutside from 'v-click-outside'


    export default {
        name: "AutoMailingComponent",
        directives: {
            clickOutside: vClickOutside.directive,
        },
        data() {
            return {
                showMenus: false,
                popupModal: null,
                mailing: [
                    {
                        name: 'p',
                        status: 'Новая',
                        url: 'RSS lenta.ru/rss/new',
                        message: 0,
                        data: '26.11.2020 16:00',
                        usersCount: '2',
                        seriesCount: '2',
                        pushCount: '2',
                    },
                    {
                        name: 'a',
                        status: 'Активная',
                        url: '123',
                        message: 2,
                        data: '26.11.2020 11:00',
                        usersCount: '3',
                        seriesCount: '2',
                        pushCount: '2',
                    },
                ],
            }
        },
        methods: {
            popupClose(){
                this.popupModal = null
            }
        },
    }
</script>

<style scoped>

</style>
