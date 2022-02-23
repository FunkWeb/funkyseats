<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')

 <div class="panel panel-inverse">
        <div class="panel-heading ui-sortable handle">
            <h4 class="panel-title"> Roles and stats</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body p-0 roles_stats">
                <h3 > Navn navnesen</h5>
                <div class="row">
                    <div class="col-6">
                        <h5> Hours this month:  </h5>
                    </div>
                    <div class="col-6">
                        <h5> Hours this week: </h5>
                    </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <h5> Mon: </h5>
                    </div>
                    <div class="col">
                        <h5> Tue: </h5>
                    </div>
                    <div class="col">
                        <h5> Wed: </h5>
                    </div>
                    <div class="col">
                        <h5> Thu: </h5>
                    </div>
                    <div class="col">
                        <h5> Fri: </h5>
                    </div>
                </div>
                    
                </div>

                <hr>
                <div class="row roles_buttons">
                    
                    <div class="col"> <h5> Add Role: </h5> </div> 
                    <div class="col">
                            <button class="submit-changes-btn roles_btn"> Veileder </button>
                    </div>
                    <div class="col">
                            <button class="submit-changes-btn roles_btn">Admin</button>
                    </div>

                    <div class="col"> <h5> Remove Role: </h5> </div> 
                    <div class="col">
                            <button class="submit-changes-btn roles_btn remove">Veileder </button>
                    </div>
                    <div class="col">
                            <button class="submit-changes-btn roles_btn remove">Admin</button>
                    </div>
                </div> 
                
                <hr>
                <div class="row delete_buttons">
                    <div class="col">
                        <button class="submit-changes-btn delMake">Delete candidate </button>
                    </div>
                    <div class="col">
                        <button class="submit-changes-btn delMake">Make anonymous </button>
                    </div>
                </div>
        </div> 
        
    </div>

    <link href="../assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <script defer src="../assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script defer src="../assets/plugins/tag-it/js/tag-it.min.js"></script>
    <script defer type='text/javascript'>

        const personJSON = `
        [
            {
                "name": "Jens",
                "name_id": "0",
                "assigned_roles":{
                    "role_name":["Veileder", "Admin"],
                    "role_id": ["0", "1"]
                    },
                "unassigned_roles":{
                    "role_name":["Leder"],
                    "role_id": ["2"]
                    }
            },
            {
                "name": "Jakob",
                "name_id": "1",
                "assigned_roles":{
                    "role_name":["Veileder"],
                    "role_id": ["0"]
                    },
                 "unassigned_roles":{
                    "role_name":["Admin","Leder"],
                    "role_id": ["1","2"]
                    }
            },
            {
                "name": "Silje",
                "name_id": "2",
                "assigned_roles":{
                    "role_name":["Admin"],
                    "role_id": ["1"]
                    },
                "unassigned_roles":{
                    "role_name":["Veilder","Leder"],
                    "role_id": ["0","2"]
                    }
            }
        ]`
        
        let parsedPerson = JSON.parse(personJSON);
        
        
</script> 

@endsection