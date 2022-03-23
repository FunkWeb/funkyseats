<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                <div class="card-body">
                    <div class="mb-3 text-white-500">
                    <select name="rooms" id="rooms" onchange="getRoomData(this.value)">
                        <option value="allRooms"><b>All rooms</b></option>
                        @foreach($rooms as $room)
                        <option value="{{$room->id}}"><b>{{$room->name}}</b></option>
                        @endforeach
                    </select>
                        
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

                <div class="row changeTime" id="interval">
                    <div class="col">
                        <button class="stats-button active" id='thisweek' 
                                onclick="createGraph('thisweek'), toggleActive(this)">This week
                        </button>
                    </div> 

                    <div class="col">
                        <button class="stats-button" id='lastweek'
                                onclick="createGraph('lastWeek'), toggleActive(this)">Last week
                        </button>
                    </div>

                    <div class="col">
                        <button class="stats-button" id='month' 
                            onclick="createGraph('month'), toggleActive(this)">This month
                        </button>
                    </div>  
                     
                    {{-- <div class="col">
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
                    </div>    --}}
                      
                       
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

        const jsonData = JSON.parse('{!! $stats !!}');
   
        let chartLoaded = false;
        let choosenInterval;
        window.onload = function() {
            if (!chartLoaded) {  
                choosenInterval = 'thisweek';
                createGraph(jsonData);
            }
            chartLoaded = true;   
        }
        
          function getRoomData(room){
            if (room){
                window.location.href = `/admin/${room}`; 
            }
            else{
                window.location.href = `/admin`; 
            }
        }

        function calculateValues(intervalValues) {
            const highCount = document.getElementById('highCount');
            const lowCount = document.getElementById('lowCount');
            const averageCount = document.getElementById('averageCount');
            const totalCount = document.getElementById('totalCount');

            highCount.innerHTML =  highCount.dataset.value ;
            lowCount.innerHTML = lowCount.dataset.value;
            averageCount.innerHTML = averageCount.dataset.value;
            totalCount.innerHTML = totalCount.dataset.value;
            highCount.setAttribute('data-value', intervalValues['high bookings']);
            lowCount.setAttribute('data-value', intervalValues['low booking']);
            averageCount.setAttribute('data-value',intervalValues['average bookings']);
            totalCount.setAttribute('data-value', intervalValues['total bookings']);  
            
        }

        function createGraph(interval) {
            choosenInterval = interval;
            function addGraph(data, dataValues) {
                d3.select(".nvd3-svg").remove();
                nv.addGraph({
                    generate: function() {
                        var BarChart = nv.models.multiBarChart()
                            .forceY([0,jsonData.seatcount])
                            .stacked(false)
                            .showControls(false)
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
                calculateValues(jsonData.lastweek);

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
                calculateValues(jsonData.month);
            } else {
                choosenInterval = 'thisweek';
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
                calculateValues(jsonData.thisweek);
            }
        }
    </script>


@endsection
