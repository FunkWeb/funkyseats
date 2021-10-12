@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <!-- <li class="breadcrumb-item"><a href="javascript:;">Home</a></li> -->
        <!-- <li class="breadcrumb-item"><a href="javascript:;">Library</a></li>
                                      <li class="breadcrumb-item active"><a href="javascript:;">Data</a></li> -->
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h4 class="fw-600 text-center">Choose a seat
        <!-- <small>header small text goes here...</small> -->
    </h4>
    <!-- end page-header -->

    <!-- begin panel -->
    <!-- <div class="panel panel-inverse">
                                      <div class="panel-heading">
                                       <h4 class="panel-title">Panel Title here</h4>
                                       <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                       </div>
                                      </div>
                                      <div class="panel-body">
                                       Panel Content Here
                                      </div>
                                     </div>
                                     -->
    <!-- end panel -->
    <div class='d-flex flex-wrap justify-content-center mt-30px'>
        <!-- <div style='width: 150px; height: 210px; border: 6px solid #9E9E9E'>
                                        <div class='d-inline-block text-center text-light text-uppercase mt-30px pt-10px'
                                        style="width: 28px; height: 28px; background-color: #8d8d8d; cursor: pointer; border-radius: 50%; border: none; font-size:16px">
                                            1
                                        </div>

                                        <div class='d-inline-block text-center text-light text-uppercase mt-30px pt-10px'
                                            style="width: 28px; height: 28px; top:82px; left:364px; background-color: #8d8d8d; cursor: pointer; border-radius: 50%; border: none; font-size:16px">
                                            2
                                        </div>

                                        <div class='d-inline-block text-center text-light text-uppercase mt-30px pt-10px'
                                            style="width: 28px; height: 28px; top:82px; right:364px; background-color: #8d8d8d; cursor: pointer; border-radius: 50%; border: none; font-size:16px">
                                            3
                                        </div>
                                        </div>
                                        <div style='width: 200px; height: 300px; border: 6px solid #9E9E9E'></div>

                                        <div class='d-inline-block position-absolute text-center text-light text-uppercase mt-30px pt-5px'
                                            style="width: 12px; height: 41px; right: 486px; top: 231px; font-size: 8px; background-color: #eceff1; cursor: pointer; border-radius: 5%; border: none; text-orientation: upright; writing-mode: vertical-rl">
                                        </div>

                                         <div class='d-inline-block position-absolute text-center text-light text-uppercase mt-30px pt-5px'
                                                style="width: 41px; height: 12px; right: 360px; top: 398px; font-size: 8px; background-color: #eceff1; cursor: pointer; border-radius: 5%; border: none; text-orientation: upright; writing-mode: vertical-rl">
                                         </div> -->

    </div>

    <div class='d-flex flex-wrap justify-content-around mt-30px'>
        @foreach ($seats as $seat)
            @component('includes.component.seat-component')
                @slot('type')
                    {{ $seat->type }}
                @endslot
                @slot('room_id')
                    {{ $seat->room_id }}
                @endslot
                @slot('seat_number')
                    {{ $seat->seat_number }}
                @endslot
            @endcomponent
        @endforeach
    </div>

@endsection
