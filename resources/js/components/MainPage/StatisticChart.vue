<template>
	<div class="wrapper_chart">
		<chart-component :chartdata="chartData"/>
	</div>
</template>

<script>
	import Chart from '../UI/Chart.vue'
	import { chartFucntions } from '../../mixins/chart.js'

	export default {
		name: "testing",
		mixins: [chartFucntions],
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
		},
		mounted() {
			this.$store.dispatch('services/FETCH_STATISTICS', {})
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

<style scoped lang="scss">
</style>