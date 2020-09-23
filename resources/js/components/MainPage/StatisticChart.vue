<template>
	<div class="wrapper_chart">
		<chart-component :chartdata="chartData"/>
	</div>
</template>

<script>
	import Chart from '../UI/Chart.vue'

	export default {
		name: "testing",
		components: {
			"chart-component": Chart
		},
		data() {
			return {
				chartData: {}
			}
		},
		computed: {
			statistics() {
				return this.$store.state.services.statistics
			},
			statisticsParam() {
				return this.$store.state.services.statisticsParam
			}
		},
		mounted() {
			this.$store.dispatch('services/FETCH_STATISTICS')
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
		},
		watch: {
			statistics: {
				handler() {
					// testing data
					let responce = {
						"mails":[{"count":1,"date":"2020-08-27"}, {"count":2,"date":"2020-08-28"}, {"count":3,"date":"2020-08-29"}, {"count":4,"date":"2020-08-30"}],
						"conversions":[{"count":5,"date":"2020-08-27"}, {"count":10,"date":"2020-08-28"}, {"count":12,"date":"2020-08-29"}, {"count":1,"date":"2020-08-30"}],
						"delivered":[{"count":3,"date":"2020-08-27"}, {"count":2,"date":"2020-08-28"}, {"count":4,"date":"2020-08-29"}, {"count":0,"date":"2020-08-30"}],
						"sent":[{"count":0,"date":"2020-08-27"}, {"count":12,"date":"2020-08-28"}, {"count":9,"date":"2020-08-29"}, {"count":6,"date":"2020-08-30"}]
					}

					this.chartData = this.converResponceData(this.statistics)
					// this.chartData = this.converResponceData(responce)
				},
				deep: true
			}
		}
	} 
</script>