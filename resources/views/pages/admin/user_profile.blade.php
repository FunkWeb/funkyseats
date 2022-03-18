<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
 <div class="panel panel-inverse">
        <div class="panel-heading ui-sortable handle">
        @if(Auth::user()->hasRole('admin'))
            <h3 class="panel-title"> Roller og statistikk</h3>
        @else
            <h3 class="panel-title"> Statistikk</h3>
        @endif
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
                        <h5> Timer denne måneden: {{$checkins->total}}</h5>
                    </div>
                    <div class="col-6">
                        <h5> Timer denne uken: {{$checkins->week}}</h5>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <h5> Tvunget: {{$checkins->forced}}</h5>
                    </div>
                    <div class="col">
                        <h5> Man: {{$checkins->Monday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Tirs: {{$checkins->Tuesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Ons: {{$checkins->Wednesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Tors: {{$checkins->Thursday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Fre: {{$checkins->Friday}}</h5>
                    </div>
                </div>
                    
                </div>

                <hr>
                @if(Auth::user()->hasRole('admin'))
                    <div class="row roles_row">
                        <div class="row roles_buttons_row">
                            <div class="col-3"> <h5 class="role_header"> Legg til rolle: </h5> </div>
                            @foreach ($roles as $role) 
                            <div class="col-2">
                            <a href="/profile/{{$user->id}}/toggle/{{$role->name}}">
                                <button class="submit-changes-btn roles_btn"> 
                                    {{Str::title ($role->name)}} 
                                    <i class="fas fa-plus"></i>
                                </button>
                            </a>
                            </div>
                            @endforeach

                        </div>
                        <div class="row roles_buttons_row">
                            <div class="col-3"> <h5 class="role_header"> Fjern rolle: </h5> </div>
                            @foreach ($user->roles as $role)
                            <div class="col-2">
                                <a href="/profile/{{$user->id}}/toggle/{{$role->name}}">
                                    <button class="submit-changes-btn roles_btn remove"> {{Str::title ($role->name)}}
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div> 
                    
                    <hr>
                    <div class="row delete_buttons">
                        <div class="col">
                            <a href="/profile/{{$user->id}}/delete'">
                            <button class="submit-changes-btn delMake_btn">Slett <i class="fas fa-trash"></i>
                            </button>
                            </a>
                        </div>
                        <div class="col">
                        <a href="/profile/{{$user->id}}/anonymize">
                            <button class="submit-changes-btn delMake_btn">
                            Anonymiser <i class="fas fa-user-secret"></i>
                            </button>
                        </a>
                        </div>
                    </div>
                @endif
        </div> 
        
    </div>

    <link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <script defer src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script defer src="../assets/plugins/tag-it/js/tag-it.min.js"></script>

@endsection