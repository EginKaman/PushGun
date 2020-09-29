import axios from 'axios'

export default {
	namespaced: true,
	state: {
		statistics: {},
		statisticsParam: {
			mails: { color: '#36C2CF', title: 'рассылок', count: 0 },
			sent: { color: '#5BA4D7', title: 'отправлено', count: 0 },
			delivered: { color: '#9698D5', title: 'доставлено', count: 0, percent: 0 },
			conversions: { color: '#68B781', title: 'переходов', count: 0, percent: 0 }
		}
	},
	getters: {
	},
	mutations: {
		setStatistics(state, data) {
			state.statistics = data
		}
	},
	actions: {
		async FETCH_STATISTICS({ state, commit }, range) {
			try {
				let _range = range || 'week'

                let {data} = await axios.get(`/statistics?range=${_range}`)
                commit("setStatistics", data)

            } catch (e) {
				console.log("ERROR -> get statistics information")
			}
		}
	}
}
