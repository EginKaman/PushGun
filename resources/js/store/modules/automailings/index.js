import axios from 'axios'

export default {
    namespaced: true,
    state: {
        automailings: []
    },
    getters: {
        getAutomailings: (state) => {
            return state.automailings;
        }
    },
    mutations: {
        setAutomailings(state, data) {
            state.automailings = data
        }
    },
    actions: {
        async FETCH_AUTOMAILINGS({ state, commit }) {
            try {
                let { data } = await axios.get(`/web-api/automailings`)
                commit("setAutomailings", data)

            } catch (e) {
                console.log("ERROR -> get automailings")
            }
        }
    }
}