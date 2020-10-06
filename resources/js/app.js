/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./landing');
require('./main');

window.Vue = require('vue');
import languageBundle
    from '@kirschbaum-development/laravel-translations-loader/json!@kirschbaum-development/laravel-translations-loader';
import VueI18n from 'vue-i18n';
import VModal from 'vue-js-modal';
import VueSwal from 'vue-swal';

Vue.use(VueI18n);
Vue.use(VModal, {
    dynamic: true,
    injectModalsContainer: true,
    dynamicDefaults: {
        draggable: false,
        resizable: false,
        height: 'auto'
    }
});
Vue.use(VueSwal);

const i18n = new VueI18n({
    fallbackLocale: 'ru',
    locale: document.documentElement.lang,
    messages: languageBundle,
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-sites-component', require('./components/HeaderSitesComponent.vue').default);
Vue.component('statistic-chart-component', require('./components/MainPage/StatisticChart.vue').default);
Vue.component('statistic-individual-chart-component', require('./components/SitesPage/StatisticChart.vue').default)
Vue.component('chart-nav-component', require('./components/UI/ChartNav.vue').default);
Vue.component('current-statistic-component', require('./components/MainPage/CurrentStatus.vue').default);
Vue.component('push-create', require('./components/PushCreate.vue').default);
Vue.component('site-check', require('./components/SiteCheck.vue').default);

Vue.component('login-button', require('./components/Index/LoginButton.vue').default);
Vue.component('register-button', require('./components/Index/RegisterButton.vue').default);
Vue.component('support-button', require('./components/Index/SupportButton.vue').default);
Vue.component('button-payment', require('./components/UI/ButtonPayment.vue').default);
Vue.component('notifications', require('./components/Notifications.vue').default);
Vue.component('question-form', require('./components/Index/Question.vue').default);
Vue.component('register-now-form', require('./components/Index/RegisterNow.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import store from './store'

const app = new Vue({
    el: '#app',
    store,
    i18n
});
