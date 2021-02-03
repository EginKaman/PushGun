import axios from 'axios'

export default {
    namespaced: true,
    state: {
        statuses: []
    },
    getters: {
        getAutomailingStatuses: (state) => {
            return state.statuses;
        }
    },
    mutations: {
        setAutomailingStatuses(state, data) {
            state.statuses = data
        }
    },
    actions: {
        async FETCH_AUTOMAILING_STATUSES({ state, commit }) {
            try {
                let { data } = await axios.get(`/web-api/automailingStatuses`)
                commit("setAutomailingStatuses", data)

            } catch (e) {
                console.log("ERROR -> get automailingStatuses")
            }
        }
    }
}