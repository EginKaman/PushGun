<script>
import { Line } from "vue-chartjs";

export default {
    extends: Line,
    props: {
        /**
         * Входные данные для графика в нужном формате
         */
        chartdata: {
            type: Object,
            default: {}
        },
        /**
         * общие свойства для графика
         */
        options: {
            type: Object,
            default() {
                return {
                    maintainAspectRatio: false,
                    title: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "#fff",
                        titleFontColor: "#323441",
                        titleMarginBottom: 12,
                        bodyFontColor: "#323441",
                        titleAlign: "center",
                        titleSpacing: 12,
                        borderColor: "#DFE0EB",
                        titleFontStyle: "600",
                        titleFontFamily: "Gilroy",
                        bodyFontStyle: "500",
                        bodyFontFamily: "Gilroy",
                        borderWidth: "1",
                        xPadding: 18,
                        yPadding: 12
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                    color: "#ffffff00"
                                },
                                ticks: {
                                    display: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#f2f2f2"
                                },
                                ticks: {
                                    fontColor: "#979797",
                                    fontFamily: "Gilroy",
                                    fontSize: 12,
                                    padding: 16,
                                    fontStyle: "bold"
                                }
                            }
                        ]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 35,
                            bottom: 70
                        }
                    },
                    legend: {
                        display: false
                    }
                };
            }
        }
    },
    watch: {
        chartdata: {
            handler() {
                this.renderChart(this.chartdata, this.options);
            },
            deep: true
        }
    }
};
</script>
