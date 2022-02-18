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
                   <input type="text" id="searchCand" placeholder="write name of person" onkeyup="searchCandidate(this)">
                    <ul id="candidates">
                        
                    </select>
                
            </div>
        </div>
    </div>

<script defer type='text/javascript'>

        const personJSON = `
        [
            {
                "name": "Jens",
                "name_id": "0",
                "roles":{
                    "role_name":["Veileder", "Admin"],
                    "role_id": ["0", "1"]
                    }
            },
            {
                "name": "Jakob",
                "name_id": "1",
                "roles":{
                    "role_name":["Veileder"],
                    "role_id": ["0"]
                    }
            },
            {
                "name": "Silje",
                "name_id": "2",
                "roles":{
                    "role_name":["Admin"],
                    "role_id": ["1"]
                    }
            }
        ]`

        const rolesList = ["Veileder", "Admin"];
        
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
                            <button class='submit-changes-btn roles' onclick="removeRole('${parsedPerson[counter].roles.role_id[0]}', '${parsedPerson[counter].name_id}')">
                             ${parsedPerson[counter].roles.role_name[0]} <i class="fa fa-times"></i> 
                            </button>
                        </div>
                    </div>
                    <div class="col">
                            <h6>Assign new role:</h6>
                         <div class="row">
                                <button class='submit-changes-btn roles' onclick="addRole('${rolesList[0]}', '${parsedPerson[counter].name_id}')">
                                    ${rolesList[0]} <i class="fa fa-check"></i> 
                                </button>
                            </div>
                            <div class="row">
                                <button class='submit-changes-btn roles' onclick="addRole('${rolesList[1]}', '${parsedPerson[counter].name_id}')">
                                    ${rolesList[1]} <i class="fa fa-check"></i> 
                                </button>
                            </div>
                         </div>                           
                    </div>   
                
                </div>
            </li>`;
            
        }
</script> 

@endsection