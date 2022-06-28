<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
 <div class="panel panel-inverse">
        <div class="panel-heading ui-sortable handle">
        {{-- @if(Auth::user()->hasRole('admin')) --}}
            <h3 class="panel-title"> Roles and stats</h3>
        {{-- @else
            <h3 class="panel-title"> Stats</h3>
        @endif --}}
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <div class="panel-body p-0 roles_stats">
                <div class="profile-week-change-buttons-row">
                    <a>
                        <button class="submit-changes-btn changeWeek_btn">
                          <i class="fas fa-chevron-left" style="color:inherit; margin-right:8px;"></i>Previous week 
                        </button>
                    </a>
                    <a>
                        <button class="submit-changes-btn changeWeek_btn">
                                Next week <i class="fas fa-chevron-right" style="color:inherit; margin-left:8px;"></i>
                        </button>
                    </a>
                </div> 
                <h3>{{$user->name ?? 'Navn Navnesen'}}</h3>
                <br>
                <h6> {{$user->email ?? 'didididi@gmail.com'}} </h6>
                       
                {{-- <h6> {{ $user->checked_in ? 'Checked in': 'Not checked in'}} </h6>  --}}
                <h6> Checked in </h6> 
                <div class="row roles_stats">
                    <div class="col-6">
                        <h5> Hours this month: {{$checkins->total ?? '5'}}</h5>
                    </div>
                    <div class="col-6">
                        <h5> Hours this week: {{$checkins->week ?? '5'}}</h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                <h4> Mon: </h4>
                    <div class="col">
                        <h6>Checked in: </h6>
                    </div>
                    <div class="col">
                         <h6>Checked Out: </h6>
                    </div>
                    <div class="col">
                        <h6> Time checked in: {{$checkins->Monday ?? '4'}}</h5>
                    </div>
                </div>

                    {{-- <div class="col">
                        <h5> Forced: {{$checkins->forced}}</h5>
                    </div> --}}
{{--                     
                    <div class="col">
                        <h5> Tue: {{$checkins->Tuesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Wed: {{$checkins->Wednesday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Thu: {{$checkins->Thursday}}</h5>
                    </div>
                    <div class="col">
                        <h5> Fri: {{$checkins->Friday}}</h5>
                    </div>
                </div>
                    
                </div> --}}

                {{-- <hr> --}}
                {{-- @if(Auth::user()->hasRole('admin'))
                    <div class="row roles_row">
                        <div class="row roles_buttons_row">
                            <div class="col-3"> <h5 class="role_header"> Add Role: </h5> </div>
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
                            <div class="col-3"> <h5 class="role_header"> Remove Role: </h5> </div>
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
                            <button class="submit-changes-btn delMake_btn">Delete <i class="fas fa-trash"></i>
                            </button>
                            </a>
                        </div>
                        <div class="col">
                        <a href="/profile/{{$user->id}}/anonymize">
                            <button class="submit-changes-btn delMake_btn">
                            Anonymize <i class="fas fa-user-secret"></i>
                            </button>
                        </a>
                        </div>
                    </div>
                @endif --}}
        </div> 
        
    </div>

    <link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <script defer src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script defer src="../assets/plugins/tag-it/js/tag-it.min.js"></script>

@endsection