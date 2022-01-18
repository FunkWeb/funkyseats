<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                <div class="card-body">
                    <div class="mb-3 text-white-500">
                        <b> SEAT STATS </b>
                    </div>
                    <div class="row percentage">

                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1">
                                <span data-animation="number" data-value="50" id="highCount"></span>
                            </h3>
                            <div> Seats booked high</div>
                        </div>

                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1">
                                <span data-animation="number" data-value="37"> </span> 
                            </h3>
                            <div> Seats booked low </div>
                        </div>

                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1">
                                <span data-animation="number" data-value="44"> </span>
                            </h3>
                            <div> Seats booked average </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
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
                var barChartData = [{
                    key: 'Total',
                    'color' : '#20B3BE',
                    values: [
                        {x:'Mon', y:50},
                        {x: 'Tue', y:44},                   
                        {x:'Wed', y:50},
                        {x: 'Thu', y:41},                   
                        {x: 'Fri', y:37}                   
                    ]
                  }, {
                    key: 'Half day',
                    color: '#324252',
                    values: [
                        {x:'Mon', y:25},
                        {x: 'Tue', y:13},
                        {x:'Wed', y:11},
                        {x: 'Thu', y:21},                   
                        {x: 'Fri', y:9}    
                    ]
                  }];
                
                  nv.addGraph({
                    generate: function() {
                        var BarChart = nv.models.multiBarChart()
                          .stacked(false)
                          .showControls(false);
                  
                        var svg = d3.select('#seats-chart').append('svg').datum(barChartData);
                        svg.transition().duration(0).call(BarChart);
                        return BarChart;
                    }    
                  });
                }
            chartLoaded = true;
    }                
        
    </script>

  
@endsection