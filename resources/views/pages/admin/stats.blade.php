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
          
        let currentWeek = [
            {
                date:{
                    day: 22,
                    month: "jan",
                    year: 2022,
                },
                bookings:{
                    total: Math.floor(Math.random() * 50) + 10,
                    halfDay: Math.floor(Math.random() * 30) + 5
                }
            },
            {
                date:{
                    day: 23,
                    month: "jan",
                    year: 2022,
                },
                bookings:{
                    total: Math.floor(Math.random() * 50) + 10,
                    halfDay: Math.floor(Math.random() * 30) + 5
                }
            },
            {
                date:{
                    day: 24,
                    month: "jan",
                    year: 2022,
                },
                bookings:{
                    total: Math.floor(Math.random() * 50) + 10,
                    halfDay: Math.floor(Math.random() * 30) + 5
                }
            },
            {
                date:{
                    day: 25,
                    month: "jan",
                    year: 2022,
                },
                bookings:{
                    total: Math.floor(Math.random() * 50) + 10,
                    halfDay: Math.floor(Math.random() * 30) + 5
                }
            },
            {
                date:{
                    day: 26,
                    month: "jan",
                    year: 2022,
                },
                bookings:{
                    total: Math.floor(Math.random() * 50) + 10,
                    halfDay: Math.floor(Math.random() * 30) + 5
                }
            }

        ];


        let lastWeek =  [{
            date:{
                day: 10,
                month: "jan",
                year: 2022,
            },
            bookings:{
                total: 33,
                halfDay: 22,
            }
        },
        {
            date:{
                day: 16,
                month: "jan",
                year: 2022,
            },
            bookings:{
                total: Math.floor(Math.random() * 50) + 10,
                halfDay: Math.floor(Math.random() * 30) + 5
            }
        },
        {
            date:{
                day: 17,
                month: "jan",
                year: 2022,
            },
            bookings:{
                total: Math.floor(Math.random() * 50) + 10,
                halfDay: Math.floor(Math.random() * 30) + 5
            }
        },
        {
            date:{
                day: 18,
                month: "jan",
                year: 2022,
            },
            bookings:{
                total: Math.floor(Math.random() * 50) + 10,
                halfDay: Math.floor(Math.random() * 30) + 5
            }
        },
        {
            date:{
                day: 19,
                month: "jan",
                year: 2022,
            },
            bookings:{
                total: Math.floor(Math.random() * 50) + 10,
                halfDay: Math.floor(Math.random() * 30) + 5
            }
        }

    ];

    currentWeek = JSON.stringify(currentWeek);
    currentWeek = JSON.parse(currentWeek);

    let chartLoaded = false;
    window.onload = function(){
        if (!chartLoaded){ 
        createGraph('current');
        }
        chartLoaded = true; 
    }


    function highestVal(chartData){
        const highCount = document.getElementById('highCount');
        const lowCount = document.getElementById('lowCount');
        const averageCount = document.getElementById('averageCount');
        let maxValue = chartData[0].bookings.total;
        let minValue = chartData[0].bookings.total;
        let totalValue = 0;
        for (let i=0; i <chartData.length; i++){
            if (chartData[i].bookings.total > maxValue){
                maxValue = chartData[i].bookings.total;
            }
            if (chartData[i].bookings.total < minValue){
                minValue = chartData[i].bookings.total;
            }
            totalValue += chartData[i].bookings.total;
        }

        let avgValue = Math.round(totalValue / chartData.length); 
        highCount.setAttribute('data-value', `${maxValue}`);
        lowCount.setAttribute('data-value', `${minValue}`);
        averageCount.setAttribute('data-value',`${avgValue}`);
        highCount.innerHTML = maxValue;
        lowCount.innerHTML = minValue;
        averageCount.innerHTML = avgValue;
        
    }
        function createGraph(interval){

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
                        var barChartDataLastW = [{
                            key: 'Total',
                        'color' : '#20B3BE',
                        values: [
                        {x:`${lastWeek[0].date.day}.${lastWeek[0].date.month}`, y:`${lastWeek[0].bookings.total}`},
                        {x:`${lastWeek[1].date.day}.${lastWeek[1].date.month}`, y:`${lastWeek[1].bookings.total}`},                
                        {x:`${lastWeek[2].date.day}.${lastWeek[2].date.month}`, y:`${lastWeek[2].bookings.total}`},                
                        {x:`${lastWeek[3].date.day}.${lastWeek[3].date.month}`, y:`${lastWeek[3].bookings.total}`},                
                        {x:`${lastWeek[4].date.day}.${lastWeek[4].date.month}`, y:`${lastWeek[4].bookings.total}`},                
                                         
                        ]
                      }, {
                        key: 'Half day',
                        color: '#324252',
                        values: [
                        {x:`${lastWeek[0].date.day}.${lastWeek[0].date.month}`, y:`${lastWeek[0].bookings.halfDay}`},
                        {x:`${lastWeek[1].date.day}.${lastWeek[1].date.month}`, y:`${lastWeek[1].bookings.halfDay}`},                
                        {x:`${lastWeek[2].date.day}.${lastWeek[2].date.month}`, y:`${lastWeek[2].bookings.halfDay}`},                
                        {x:`${lastWeek[3].date.day}.${lastWeek[3].date.month}`, y:`${lastWeek[3].bookings.halfDay}`},                
                        {x:`${lastWeek[4].date.day}.${lastWeek[4].date.month}`, y:`${lastWeek[4].bookings.halfDay}`},      
                        ]
                          }];
                          addGraph(barChartDataLastW);
                          highestVal(lastWeek);
                   }

                   else if (interval === 'month' || interval === 'lastMonth'){
                    var barChartDataM = [{
                        key: 'Total',
                        'color' : '#20B3BE',
                        values: [
                        {x:`${lastWeek[0].date.day}.${lastWeek[0].date.month}`, y:`${lastWeek[0].bookings.total}`},
                        {x:`${lastWeek[1].date.day}.${lastWeek[1].date.month}`, y:`${lastWeek[1].bookings.total}`},                
                        {x:`${lastWeek[2].date.day}.${lastWeek[2].date.month}`, y:`${lastWeek[2].bookings.total}`},                
                        {x:`${lastWeek[3].date.day}.${lastWeek[3].date.month}`, y:`${lastWeek[3].bookings.total}`},                
                        {x:`${lastWeek[4].date.day}.${lastWeek[4].date.month}`, y:`${lastWeek[4].bookings.total}`},
                        {x:`${currentWeek[0].date.day}.${currentWeek[0].date.month}`, y:`${currentWeek[0].bookings.total}`},
                        {x:`${currentWeek[1].date.day}.${currentWeek[1].date.month}`, y:`${currentWeek[1].bookings.total}`},                
                        {x:`${currentWeek[2].date.day}.${currentWeek[2].date.month}`, y:`${currentWeek[2].bookings.total}`},                
                        {x:`${currentWeek[3].date.day}.${currentWeek[3].date.month}`, y:`${currentWeek[3].bookings.total}`},                
                        {x:`${currentWeek[4].date.day}.${currentWeek[4].date.month}`, y:`${currentWeek[4].bookings.total}`},   
                        ]
                      }, {
                        key: 'Half day',
                        color: '#324252',
                        values: [
                        {x:`${lastWeek[0].date.day}.${lastWeek[0].date.month}`, y:`${lastWeek[0].bookings.halfDay}`},
                        {x:`${lastWeek[1].date.day}.${lastWeek[1].date.month}`, y:`${lastWeek[1].bookings.halfDay}`},                
                        {x:`${lastWeek[2].date.day}.${lastWeek[2].date.month}`, y:`${lastWeek[2].bookings.halfDay}`},                
                        {x:`${lastWeek[3].date.day}.${lastWeek[3].date.month}`, y:`${lastWeek[3].bookings.halfDay}`},                
                        {x:`${lastWeek[4].date.day}.${lastWeek[4].date.month}`, y:`${lastWeek[4].bookings.halfDay}`},
                        {x:`${currentWeek[0].date.day}.${currentWeek[0].date.month}`, y:`${currentWeek[0].bookings.halfDay}`},
                        {x:`${currentWeek[1].date.day}.${currentWeek[1].date.month}`, y:`${currentWeek[1].bookings.halfDay}`},
                        {x:`${currentWeek[2].date.day}.${currentWeek[2].date.month}`, y:`${currentWeek[2].bookings.halfDay}`},                
                        {x:`${currentWeek[3].date.day}.${currentWeek[3].date.month}`, y:`${currentWeek[3].bookings.halfDay}`},                
                        {x:`${currentWeek[4].date.day}.${currentWeek[4].date.month}`, y:`${currentWeek[4].bookings.halfDay}`},  
                           
                        ]
                      }];
                      addGraph(barChartDataM);

                   }
                   else{
                    var barChartData = [{
                        key: 'Total',
                        'color' : '#20B3BE',
                        values: [
                        {x:`${currentWeek[0].date.day}.${currentWeek[0].date.month}`, y:`${currentWeek[0].bookings.total}`},
                        {x:`${currentWeek[1].date.day}.${currentWeek[1].date.month}`, y:`${currentWeek[1].bookings.total}`},                
                        {x:`${currentWeek[2].date.day}.${currentWeek[2].date.month}`, y:`${currentWeek[2].bookings.total}`},                
                        {x:`${currentWeek[3].date.day}.${currentWeek[3].date.month}`, y:`${currentWeek[3].bookings.total}`},                
                        {x:`${currentWeek[4].date.day}.${currentWeek[4].date.month}`, y:`${currentWeek[4].bookings.total}`},                
                                         
                        ]
                      }, {
                        key: 'Half day',
                        color: '#324252',
                        values: [
                        {x:`${currentWeek[0].date.day}.${currentWeek[0].date.month}`, y:`${currentWeek[0].bookings.halfDay}`},
                        {x:`${currentWeek[1].date.day}.${currentWeek[1].date.month}`, y:`${currentWeek[1].bookings.halfDay}`},
                        {x:`${currentWeek[2].date.day}.${currentWeek[2].date.month}`, y:`${currentWeek[2].bookings.halfDay}`},                
                        {x:`${currentWeek[3].date.day}.${currentWeek[3].date.month}`, y:`${currentWeek[3].bookings.halfDay}`},                
                        {x:`${currentWeek[4].date.day}.${currentWeek[4].date.month}`, y:`${currentWeek[4].bookings.halfDay}`},     
                        ]
                      }];
                      addGraph(barChartData);
                      highestVal(currentWeek);
                    }
                }

                   
    </script>

  
@endsection