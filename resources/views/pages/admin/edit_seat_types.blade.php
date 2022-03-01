<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

    @section('content')
    {{$types}}
        <div class='panel panel-inverse'>
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit seat-types</h4>
                <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            
            <div class="panel-body">
            @foreach($types as $type)
                <form action=/admin/edit_seat_types/edit/{{ $type->id }} method="post" class="form-group seat_types_form">
                @csrf
                    <div class="row trash_icon"><i class="far fa-trash-alt fa-lg" onclick="showWindow()"></i> </div>
                    <div class="row">
                        <div class="col-4">
                            <label for ="seat-type-name">Seat-name</label>
                            <input type="text" class="form-control" id="seat-type-name" name="{{$type->name}}" value="{{$type->name}}">
                        </div>
                                    
                        <div class="col">    
                            <label for="seat_description">Seat description</label>
                            <textarea class="form-control" id="seat_description" name="description" placeholder="Write seat description">{{$type->description}}</textarea>
                        </div>  
                    </div>
                                        
                        <div class="row edit_seat_type_btns_row">
                                <button class='submit-changes-btn seat_type_btn' type='submit' value='submit'>Update</button>
                        </div>  
                </form>
            @endforeach   
            </div>
        </div>    
    @endsection