<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                <div class="card-body">
                    <div class="mb-3 text-white-500">
                        <b> Room name </b>
                    </div>
                    <div class="row statsCalc">

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="highCount"></span>
                            </h5>
                            <div> Seats booked high</div>
                        </div>

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="lowCount"> </span>
                            </h5>
                            <div> Seats booked low </div>
                        </div>

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="averageCount"> </span>
                            </h5>
                            <div> Seats booked average </div>
                        </div>

                    </div>
                </div>

                <div class="row changeTime">

                    <div class="col">
                        <button class="stats-button" onclick="createGraph('lastWeek'), toggleActive(this)">Last week
                        </button>
                        <button class="stats-button active" onclick="createGraph('current'), toggleActive(this)">This week
                        </button>
                        <button class="stats-button" onclick="createGraph('lastMonth'), toggleActive(this)">Last month
                        </button>
                        <button class="stats-button" onclick="createGraph('month'), toggleActive(this)">This month
                        </button>
                    </div>
                </div>

                <div class="card-body chart">
                    <div class="panel-body">
                        <div id="seats-chart" class="h-250px"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <script defer src="/assets/plugins/d3/d3.min.js"></script>
    <script defer src="/assets/plugins/nvd3/build/nv.d3.min.js"></script>
    <script defer type='text/javascript'>
        let jsonData = JSON.parse('{!! $stats !!}');
        let chartWeekTotal = [];
        let chartWeekHalf = [];
        let lastWeekTotal = [];
        let lastWeekHalf = [];
        let chartMonthTotal = [];
        let chartMonthHalf = [];

        chartWeekTotal = jsonData.thisweek.wholedays;
        chartWeekHalf = jsonData.thisweek.halfdays;
        lastWeekHalf = jsonData.lastweek.halfdays;
        lastWeekTotal = jsonData.lastweek.wholedays;
        chartMonthTotal = jsonData.month.wholedays;
        chartMonthHalf = jsonData.month.halfdays;

        let chartLoaded = false;
        window.onload = function() {
            if (!chartLoaded) {
                createGraph('current');
            }
            chartLoaded = true;
        }


        function highestVal(chartData) {
            const highCount = document.getElementById('highCount');
            const lowCount = document.getElementById('lowCount');
            const averageCount = document.getElementById('averageCount');
            let maxValue = chartData[0].y;
            let minValue = chartData[0].y;
            let totalValue = 0;
            for (let i = 0; i < chartData.length; i++) {
                chartData[i].y = parseInt(chartData[i].y);
                if (chartData[i].y > maxValue) {
                    maxValue = chartData[i].y;
                }
                if (chartData[i].y < minValue) {
                    minValue = chartData[i].y;
                }
                totalValue += chartData[i].y;
            }
            let avgValue = Math.round(totalValue / chartData.length);
            highCount.setAttribute('data-value', `${maxValue}`);
            lowCount.setAttribute('data-value', `${minValue}`);
            averageCount.setAttribute('data-value', `${avgValue}`);
            highCount.innerHTML = maxValue;
            lowCount.innerHTML = minValue;
            averageCount.innerHTML = avgValue;

        }

        function createGraph(interval) {

            function addGraph(data) {
                d3.select(".nvd3-svg").remove();
                nv.addGraph({
                    generate: function() {
                        var BarChart = nv.models.multiBarChart()
                            .stacked(false)
                            .showControls(false);
                        var svg = d3.select('#seats-chart').append('svg').datum(data);
                        svg.transition().duration(0).call(BarChart);
                        return BarChart;
                    }
                });
            }
            if (interval === 'lastWeek') {
                var barChartDataLastW = [{
                    key: 'Total',
                    'color': '#20B3BE',
                    values: lastWeekTotal
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: lastWeekHalf
                }];
                addGraph(barChartDataLastW);
                highestVal(barChartDataLastW[0].values);
            } else if (interval === 'month' || interval === 'lastMonth') {
                var barChartDataM = [{
                    key: 'Total',
                    'color': '#20B3BE',
                    values: chartMonthTotal
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: chartMonthHalf
                }];
                addGraph(barChartDataM);
                highestVal(barChartDataM[0].values);
            } else {
                var barChartData = [{
                    key: 'Total',
                    'color': '#20B3BE',
                    values: chartWeekTotal
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: chartWeekHalf
                }];
                addGraph(barChartData);
                highestVal(barChartData[0].values);
            }
        }
    </script>


@endsection
