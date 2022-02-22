<script src="/assets/js/admin-page.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')

 <div class="row stats">
        <div class="col">
            <div class="card border-0 mb-3 bg-gray-800 text-white">
                    <div class="mb-3 text-white-500">
                        <b>  Role assignements </b>
                    </div>
                    <form name="roles_form" method="POST">
                    </form>
                   <input type="text" id="searchCand" placeholder="write name of person" onkeyup="searchCandidate(this)">
                    <ul id="candidates">
                    </ul>               
            </div>
        </div>
    </div>

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
        const candidatesList = document.getElementById('candidates'); 
        for (let counter = 0; counter < parsedPerson.length; counter++){
                candidatesList.innerHTML += `
            <li class="personList hidden">
                <div class="row">     
                    <h5>${parsedPerson[counter].name}</h5>
                </div>

                <div class="row">
                    <div class="col">
                            <h6> Remove role: </h6>
                        <div class="row">
                            <div class="col-3">
                                <button class='submit-changes-btn roles' onclick="removeRole('${parsedPerson[counter].assigned_roles.role_id[0]}', '${parsedPerson[counter].name_id}')">
                                ${parsedPerson[counter].assigned_roles.role_name[0]} <i class="fa fa-times"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                            <h6>Assign new role:</h6>
                         <div class="row">
                                <div class="col-3">
                                    <button class='submit-changes-btn roles assign' onclick="addRole('${parsedPerson[counter].unassigned_roles.role_id[0]}', '${parsedPerson[counter].name_id}')">
                                        ${parsedPerson[counter].unassigned_roles.role_name[0]} <i class="fa fa-check"></i> 
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button class='submit-changes-btn roles assign' onclick="addRole('${parsedPerson[counter].unassigned_roles.role_id[1]}', '${parsedPerson[counter].name_id}')">
                                        ${parsedPerson[counter].unassigned_roles.role_name[1]} <i class="fa fa-check"></i> 
                                    </button>
                                </div>
                            </div>
                         </div>                           
                    </div>   
                
                </div>
            </li>`;
            
        }
</script> 

@endsection