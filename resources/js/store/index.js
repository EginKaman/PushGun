import Vue from 'vue'
import Vuex from 'vuex'
import services from './modules/services'
import sites from './modules/sites'
import automailings from './modules/automailings'
import times from './modules/times'

Vue.use(Vuex);

export default new Vuex.Store({
    actions: {},
    mutations: {},
    state: {},
    getters: {},
    modules: {
        services,
        sites,
        automailings,
        times
    }
})