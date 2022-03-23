<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                <div class="card-body">
                    <div class="mb-3 text-white-500">
                    <select name="rooms" id="rooms" onchange="createCookie(this.id, this.value, 0), getRoomData(this.value)">
                        <option value="all"><b>All rooms</b></option>
                        {{-- @foreach($rooms as $room)
                        <option value="{{$room->id}}"><b>{{$room->name}}</b></option>
                        @endforeach --}}
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
                                onclick="createCookie(this.parentElement.parentElement.id, this.id, 0), createGraph(), toggleActive() ">This week
                        </button>
                    </div> 

                    <div class="col">
                        <button class="stats-button" id='lastweek'
                                onclick="createCookie(this.parentElement.parentElement.id, this.id, 0),createGraph(), toggleActive()">Last week
                        </button>
                    </div>

                    <div class="col">
                        <button class="stats-button" id='month' 
                            onclick="createCookie(this.parentElement.parentElement.id, this.id, 0),createGraph(), toggleActive()">This month
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

        function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }

        function eraseCookie(name) {
        createCookie(name,"",-1);
        }        

        const jsonData = JSON.parse('{!! $stats !!}');
   
        let chartLoaded = false;
        let choosenInterval = readCookie('interval') ? readCookie('interval') : 'thisweek';
        window.onload = function() {
            if (!chartLoaded) {  
                createGraph(jsonData);
                selectOption(readCookie('rooms'));
                toggleActive();
            }
            chartLoaded = true;   
        }
        
          function getRoomData(room){
            if (room === "all"){
                window.location.href = `/admin`; 
            }
            else{
                 window.location.href = `/admin/${room}`; 
            }
        }

        function selectOption(room){
            console.log(room);
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

        function createGraph() {
            choosenInterval = readCookie('interval');
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
            if (choosenInterval === 'lastWeek') {
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

            } else if (choosenInterval === 'month' || choosenInterval === 'lastMonth') {
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
            } else if(choosenInterval = 'thisweek'){
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

    function toggleActive(){
        const buttons = document.getElementsByClassName("stats-button");
        let interval = readCookie('interval');
        let buttonSelect = document.getElementById(interval);
        for (let i=0; i < buttons.length; i++){
            const current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            buttonSelect.className+= " active";
        }   
    }
</script>


@endsection
