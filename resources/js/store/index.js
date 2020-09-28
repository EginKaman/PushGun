import Vue from 'vue'
import Vuex from 'vuex'
import services from './modules/services'
import sites from './modules/sites'

Vue.use(Vuex);

export default new Vuex.Store({
    actions: {},
    mutations: {},
    state: {},
    getters: {},
    modules: {
        services,
        sites
    }
})
