<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')

 <div class="panel panel-inverse">
        <div class="panel-heading ui-sortable handle">
            <h3 class="panel-title"> Roles and stats</h3>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <div class="panel-body p-0 roles_stats">
                <h3>{{$user->name}}</h3>
                <br>
                <h6> {{$user->email}} </h6> 
                <div class="row roles_stats">
                    <div class="col-6">
                        <h5> Hours this month: 70</h5>
                    </div>
                    <div class="col-6">
                        <h5> Hours this week: 20</h5>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <h5> Mon: 2</h5>
                    </div>
                    <div class="col">
                        <h5> Tue: 2</h5>
                    </div>
                    <div class="col">
                        <h5> Wed: 2</h5>
                    </div>
                    <div class="col">
                        <h5> Thu: 1</h5>
                    </div>
                    <div class="col">
                        <h5> Fri: 2</h5>
                    </div>
                </div>
                    
                </div>

                <hr>
                <div class="row roles_row">
                    <div class="row roles_buttons_row">
                        <div class="col-3"> <h5 class="role_header"> Add Role: </h5> </div>
                        @foreach ($roles as $role)
                        <div class="col-2">
                               <button class="submit-changes-btn roles_btn"> {{Str::title ($role->name)}} <i class="fas fa-plus"></i></button>
                        </div>
                        @endforeach

                    </div>
                    <div class="row roles_buttons_row">
                        <div class="col-3"> <h5 class="role_header"> Remove Role: </h5> </div> 
                        <div class="col-2">
                                <button class="submit-changes-btn roles_btn remove">Veileder <i class="fas fa-minus"></i> </button>
                        </div>
                        <div class="col-2">
                                <button class="submit-changes-btn roles_btn remove">Veileder <i class="fas fa-minus"></i> </button>
                        </div>
                        <div class="col-2">
                                <button class="submit-changes-btn roles_btn remove">Veileder <i class="fas fa-minus"></i> </button>
                        </div>
                    </div>
                </div> 
                
                <hr>
                <div class="row delete_buttons">
                    <div class="col">
                        <button class="submit-changes-btn delMake_btn">Delete <i class="fas fa-trash"></i></button>
                    </div>
                    <div class="col">
                        <button class="submit-changes-btn delMake_btn">Anonymize <i class="fas fa-user-secret"></i></button>
                    </div>
                </div>
        </div> 
        
    </div>

    <link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <script defer src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script defer src="../assets/plugins/tag-it/js/tag-it.min.js"></script>

@endsection