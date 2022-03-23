<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')
<div class="overlay">
    @section('content')
        <div class='panel panel-inverse'>
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Edit seat-types</h4>
                <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
            </div>
            
            <div class="panel-body">
                <div id="addNewSeatType">
                    @foreach($types as $type)
                        @component('includes.component.edit-seat-types-component')
                        @slot('id')
                        {{$type->id}}
                        @endslot
                        @slot('name')
                            {{$type->name}}
                        @endslot
                        @slot('description')
                            {{$type->description}}
                        @endslot
                        @endcomponent
                    @endforeach
            
                </div>   
            </div>

            <div class="popup-container">

            </div>
        </div>    
    @endsection
</div>