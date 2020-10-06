export const chartFucntions = {
	computed: {
		statisticsParam() {
			return this.$store.state.services.statisticsParam
		}
	},
	methods: {
		converResponceData(responce) {
			if (responce?.mails == undefined || Object.keys(responce).length == 0) return

			let labels = responce.mails.map(item => item.date)

			let datasets = []

			// общие параметры для тултайпа
			let defaultTooltypeParams = {
        fill: false,
        pointBorderColor: '#ffffff00',
        pointHoverBackgroundColor: '#ffffff00',
        pointHoverBorderColor: '#ffffff00',
        pointBackgroundColor: '#ffffff00',
        backgroundColor: 'transparent',
        pointHitRadius: 32,
			}

			// параметры для подписи кривых (наименование и цвет)
			let params = this.statisticsParam

			for(let i in responce) {
				datasets.push({
					...defaultTooltypeParams,
					data: responce[i].map(item => item.count),
					label: params[i].title,
					borderColor: params[i].color
				})
			}

			return {
				labels: labels,
				datasets: datasets					
			}
		}
	}
}