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

                        <div class="col highLow">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="highCount"></span>
                            </h5>
                            <div> Highest booking</div>
                        </div>

                        <div class="col highLow">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="lowCount"> </span>
                            </h5>
                            <div> Lowest booking </div>
                        </div>

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="averageCount"> </span>
                            </h5>
                            <div> Average booking </div>
                        </div>
                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="" id="totalCount"> </span>
                            </h5>
                            <div> Total bookings </div>
                        </div>

                    </div>
                </div>

                <div class="row changeTime">
                    <div class="col">
                        <button class="stats-button active" onclick="createGraph('current'), toggleActive(this)">This week
                        </button>
                    </div>  

                    <div class="col">
                        <button class="stats-button" onclick="createGraph('month'), toggleActive(this)">This month
                        </button>
                    </div>  

                    <div class="col">
                        <button class="stats-button" onclick="createGraph('lastWeek'), toggleActive(this)">Last week
                        </button>
                    </div>
                     
                    <div class="col">
                        <!-- Lage en select drop-down-->
                        <div class="drop-down">
                            <button class="stats-button drop">Prev. months</button>
                            <div class="dropdown-content">
                                <button class="stats-button" onclick="createGraph('lastMonth'), toggleActive(this)">Last Month
                                </button>
                                <button class="stats-button" onclick="createGraph('lastMonth'), toggleActive(this)">December
                                </button>
                                <button class="stats-button" onclick="createGraph('lastMonth'), toggleActive(this)">November
                                </button>
                                
                            </div>
                        </div>
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

    <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                    <div class="mb-3 text-white-500">
                        <b>  Candidate stats </b>
                    </div>
                   <input type="text" id="searchCand" placeholder="write name of candidate" onkeyup="searchCandidate(this)">
                    <ul id="candidates">
                        <li value="jens"><button class="stats-button candidate" onclick="showCandStats(this.parentNode), toggleActive(this)" > Jens </button> <div> </div></li>
                        <li value="jakob"><button class="stats-button candidate" onclick="showCandStats(this.parentNode), toggleActive(this)"> Jakob </button><div> </div></li>
                        <li value="nils"><button class="stats-button candidate"> Nils </button></li>
                        <li value="franz"><button class="stats-button candidate"> Franz </button></li>
                    </ul>
                
            </div>
        </div>
       

    </div>


    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <script defer src="/assets/plugins/d3/d3.min.js"></script>
    <script defer src="/assets/plugins/nvd3/build/nv.d3.min.js"></script>
    <script defer type='text/javascript'>

        const personJSON = `
        [
            {
                "name": "Jens",
                "hoursWeek": "14",
                "hoursMonth": "50",
                "days":{
                    "Mon": "2",
                    "Tue": "3",
                    "Wed": "4",
                    "Thu": "1",
                    "Fri": "0"
                    }
            }
        ]`
        

        let parsedPerson = JSON.parse(personJSON); 

        let jsonData = JSON.parse('{!! $stats !!}');
        let chartLoaded = false;
        window.onload = function() {
            if (!chartLoaded) {
                createGraph('current');
            }
            chartLoaded = true;
        }


        function highestVal(intervalValues) {
            const highCount = document.getElementById('highCount');
            const lowCount = document.getElementById('lowCount');
            const averageCount = document.getElementById('averageCount');
            const totalCount = document.getElementById('totalCount');
            highCount.setAttribute('data-value', intervalValues['high bookings']);
            lowCount.setAttribute('data-value', intervalValues['low booking']);
            averageCount.setAttribute('data-value',intervalValues['average bookings']);
            totalCount.setAttribute('data-value', intervalValues['total bookings']);

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
                    values: jsonData.lastweek.wholedays
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: jsonData.lastweek.halfdays
                }];
                addGraph(barChartDataLastW);
                highestVal(jsonData.lastweek);

            } else if (interval === 'month' || interval === 'lastMonth') {
                var barChartDataM = [{
                    key: 'Total',
                    'color': '#20B3BE',
                    values: jsonData.month.wholedays
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: jsonData.month.halfdays
                }];
                addGraph(barChartDataM);
                highestVal(jsonData.month);
            } else {
                var barChartData = [{
                    key: 'Total',
                    'color': '#20B3BE',
                    values: jsonData.thisweek.wholedays
                }, {
                    key: 'Half day',
                    color: '#324252',
                    values: jsonData.thisweek.halfdays
                }];
                addGraph(barChartData);
                highestVal(jsonData.thisweek);
            }
        }
    </script>


@endsection
