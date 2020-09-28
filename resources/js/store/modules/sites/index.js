import axios from 'axios'

export default {
    namespaced: true,
    state: {
        sites: []
    },
    getters: {
        getSites: (state) => {
            return state.sites;
        }
    },
    mutations: {
        setSites(state, data) {
            state.sites = data
        }
    },
    actions: {
        async FETCH_SITES({state, commit}) {
            try {
                let {data} = await axios.get(`/site`)
                commit("setSites", data.data)

            } catch (e) {
                console.log("ERROR -> get sites information")
            }
        }
    }
}
