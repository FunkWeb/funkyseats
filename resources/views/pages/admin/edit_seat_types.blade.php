<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

    @section('content')
        <div class='panel panel-inverse'>
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit seat-types</h4>
                <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group seat_types_form">
                    <div class="row">
                        <div class="col-4">
                            <label for ="seat-type-name">Seat-name</label>
                            <i class="far fa-trash-alt fa-lg seat_types_remove" onclick="showWindow()"></i>
                            <input type="text" class="form-control" id="seat-type-name" placeholder="Arbeidsplass">
                        </div>
                                    
                        <div class="col">    
                            <label for="seat_description">Seat description</label>
                            <textarea class="form-control" id="seat_description" placeholder="Write seat description"></textarea>
                        </div>    
                    </div>
                                        
                        <div class="row edit_seat_type_btns_row">
                            <div class="col">
                                <button class='submit-changes-btn' type='submit' value='submit'>Update</button>
                            </div>
                            <div class="col">
                                <button class='submit-changes-btn' type='submit' value='submit'>Remove</button>
                            </div>
                        </div>  
                </div>
            </div>
        </div>    
    @endsection