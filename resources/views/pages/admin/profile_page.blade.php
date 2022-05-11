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
                    <th class="text-nowrap sorting"> Status </th>
                    <th class="text-nowrap sorting"> E-mail </th>
                    <th class="text-nowrap sorting"> Created </th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->id}} </td>
                            <td> <img src="{{ $user->user_thumbnail}}" width="100%"> </td>
                            <td> {{ $user->name}}
                            <br> 
                            <a href="/profile/{{$user->id}}"> <h6>Profile page <h6></a>
                            </td>
                            
                            <td>
                            {{ $user->checked_in ? 'Checked in': 'Not checked in'}}
                            </td>
                            <td> {{ $user->email}} </td>
                            <td> {{ $user->created_at}} </td>
                        </tr>
                    @endforeach
                    
                
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

    <script defer type= text/javascript>

    function docReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
    }  
    docReady(function() {
       $('#data-table-select').DataTable({
        "columnDefs": [
        { "searchable": false, "targets": [0,1,3,4] }
        ],
            responsive: true
        }); 
    });               
            
</script>

@endsection