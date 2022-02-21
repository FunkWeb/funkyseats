<script src="/assets/js/admin-page.js"></script>
@extends('layouts.default')

@section('title', 'Home Page')

@section('content')
    <div class="col-xl-10-ui-sortable">
        <div class="panel panel-inverse">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">User Profiles</h4>
                <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
            <table id="data-table-select" class="table table-striped table-bordered align-middle">
                <thead>
                <tr>
                    <th width="1%"> #</th>
                    <th width="1%" data-orderable="false"> Photo </th>
                    <th class="text-nowrap sorting"> Name </th>
                    <th class="text-nowrap sorting"> E-mail </th>
                    <th class="text-nowrap sorting"> Created </th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
            </div>
        </div>
    </div>    

<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="../assets/plugins/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" />
<script defer src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script defer src="../assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script defer src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script defer src="../assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script defer src="../assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
<script defer src="../assets/plugins/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
<!-- script -->
    <script defer type= text/javascript>
    let jsonTable = '{!!$users!!}';
    const usersTable = JSON.parse(jsonTable);
    const displayTable = document.getElementById('data-table-select');
    const tBody = displayTable.getElementsByTagName('tbody')[0];
    console.log(usersTable);

    let loaded = false;
    window.onload = function(){  
        if(!loaded){

            $('#data-table-select').DataTable({
  	        select: true,
        responsive: true
            });
             usersTable.forEach((item,index) => {
    const tr = document.createElement('tr');   

    const td1 = document.createElement('td');
    const td2 = document.createElement('td');
    const td3 = document.createElement('td');

    const indexed = document.createTextNode(index);
    const photo = document.createTextNode(item.user_thumbnail);
    const name = document.createTextNode(item.name);
    td1.appendChild(indexed);
    td2.appendChild(photo);
    td3.appendChild(name);
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);

    tBody.appendChild(tr);
    });
     loaded = true;    
        }
 
    }
   
</script>

@endsection