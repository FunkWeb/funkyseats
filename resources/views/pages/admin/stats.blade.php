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
                                <span data-animation="number" data-value="50" id="highCount"></span>
                            </h5>
                            <div> Seats booked high</div>
                        </div>

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="37"> </span> 
                            </h5>
                            <div> Seats booked low </div>
                        </div>

                        <div class="col">
                            <h5 class="mb-1">
                                <span data-animation="number" data-value="44"> </span>
                            </h5>
                            <div> Seats booked average </div>
                        </div>

                    </div>
                </div>

                <div class="row changeTime">
                 
                    <div class="col">
                        <button class="stats-button" onclick="createGraph('lastWeek'), toggleActive(this)">Last week </button>
                        <button class="stats-button active" onclick="createGraph('current'), toggleActive(this)">This week </button>
                        <button class="stats-button" onclick="createGraph('lastMonth'), toggleActive(this)">Last month </button>
                        <button class="stats-button" onclick="createGraph('month'), toggleActive(this)">This month </button>
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


    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <script defer src="/assets/plugins/d3/d3.min.js"></script>
    <script defer src="/assets/plugins/nvd3/build/nv.d3.min.js"></script>
    <script defer type='text/javascript'>
    let chartLoaded = false;
    window.onload = function(){    
        if (!chartLoaded){ 
        createGraph('current');
        }
        chartLoaded = true; 
    }
        function createGraph(interval){
            let today = 17;
            let i;
            let month = '.jan'
            function addGraph(data){
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
                
                    if (interval === 'lastWeek'){
                        i = 7;
                        var barChartDataLastW = [{
                            key: 'Total',
                            'color' : '#20B3BE',
                            values: [
                                {x:`${today - i}${month}`, y:50},
                                {x: `${today - i + 1}${month}`, y:44},                   
                                {x:`${today - i + 2}${month}`, y:50},
                                {x:`${today - i + 3}${month}`, y:41},                   
                                {x:`${today - i + 4}${month}`, y:37}                   
                            ]
                          }, {
                            key: 'Half day',
                            color: '#324252',
                            values: [
                                {x:`${today - i}${month}`, y:25},
                                {x:`${today - i + 1}${month}`, y:13},
                                {x:`${today - i + 2}${month}`, y:11},
                                {x:`${today - i + 3}${month}`, y:21},                   
                                {x:`${today - i + 4}${month}`, y:9}    
                            ]
                          }];
                          addGraph(barChartDataLastW);
                   }

                   else if (interval === 'month' || interval === 'lastMonth'){
                    i = 16;
                    var barChartDataM = [{
                        key: 'Total',
                        'color' : '#20B3BE',
                        values: [
                            {x:`1${month}`, y:50},
                            {x:`2${month}`, y:44},                   
                            {x:`3${month}`, y:50},
                            {x: '4', y:41},                   
                            {x: '5', y:37},                   
                            {x:`8`, y:50},
                            {x: '9', y:44},                   
                            {x:'10', y:50},
                            {x: '11', y:41},                   
                            {x: '12', y:37},                   
                            {x:`15`, y:50},
                            {x: '16', y:44},                   
                            {x:'17', y:50},
                            {x: '18', y:41},                   
                            {x: '19', y:37},                   
                            {x:`22`, y:50},
                            {x: '23', y:44},                   
                            {x:'24', y:50},
                            {x: '25', y:41},                   
                            {x: '26', y:37}                   
                        ]
                      }, {
                        key: 'Half day',
                        color: '#324252',
                        values: [
                        {x:`1${month}`, y:5},
                        {x:`2${month}`, y:4},                   
                        {x:`3${month}`, y:5},
                        {x: '4', y:4},                   
                        {x: '5', y:3},                   
                        {x:`8`, y:5},
                        {x: '9', y:4},                   
                        {x:'10', y:5},
                        {x: '11', y:4},                   
                        {x: '12', y:3},                   
                        {x:`15`, y:5},
                        {x: '16', y:4},                   
                        {x:'17', y:5},
                        {x: '18', y:4},                   
                        {x: '19', y:3},                   
                        {x:`22`, y:5},
                        {x: '23', y:4},                   
                        {x:'24', y:5},
                        {x: '25', y:4},                   
                        {x: '26', y:3}     
                        ]
                      }];
                      addGraph(barChartDataM);

                   }
                   else{
                    i = 0;
                    var barChartData = [{
                        key: 'Total',
                        'color' : '#20B3BE',
                        values: [
                            {x:`${today - i}${month}`, y:41},
                            {x: `${today - i + 1}${month}`, y:44},                   
                            {x:`${today - i + 2}${month}`, y:33},
                            {x:`${today - i + 3}${month}`, y:37},                   
                            {x:`${today - i + 4}${month}`, y:37}                   
                        ]
                      }, {
                        key: 'Half day',
                        color: '#324252',
                        values: [
                            {x:`${today - i}${month}`, y:25},
                            {x:`${today - i + 1}${month}`, y:13},
                            {x:`${today - i + 2}${month}`, y:17},
                            {x:`${today - i + 3}${month}`, y:21},                   
                            {x:`${today - i + 4}${month}`, y:19}    
                        ]
                      }];
                      addGraph(barChartData);
                    }
                }

                   
    </script>

  
@endsection