import axios from 'axios'

export default {
    namespaced: true,
    state: {
        times: []
    },
    getters: {
        getTimes: (state) => {
            return state.times;
        }
    },
    mutations: {
        setTimes(state, data) {
            state.times = data
        }
    },
    actions: {
        async FETCH_TIMES({ state, commit }) {
            try {
                let { data } = await axios.get(`/web-api/times`)
                commit("setTimes", data)

            } catch (e) {
                console.log("ERROR -> get times")
            }
        }
    }
}