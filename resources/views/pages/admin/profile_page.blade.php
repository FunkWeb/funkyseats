<script src="/assets/js/admin-page.js"></script>
<!-- required files -->
<link href="../assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="../assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="../assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" />
<script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="../assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="../assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="../assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

@extends('layouts.default')

@section('title', 'Home Page')

@section('content')

    <table id="data-table-select" class="table table-striped table-bordered align-middle">
  <thead>
    <tr>
      <th width="1%"></th>
      <th width="1%" data-orderable="false"></th>
      ...
    </tr>
  </thead>
  <tbody>
    ...
  </tbody>
</table>

<!-- script -->
<script>
  $('#data-table-select').DataTable({
  	select: true,
    responsive: true
  });
</script>

@endsection