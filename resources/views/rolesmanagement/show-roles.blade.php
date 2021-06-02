<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP__NAME')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('vendors/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vendors/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
  <!-- Navbar -->
  @include('common.navbar')
  <!-- /.navbar -->
 @include('common.sidebar')
  <!-- Main Sidebar Container -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Role Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with Roles</h3>
                <a href="/roles/create" class="btn btn-primary" style="    float: right;">Create Role</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table id="category_table" class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th> Name</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('common.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('vendors/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('vendors/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


<!-- AdminLTE App -->
<script src="{{asset('vendors/plugins/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('vendors/dist/js/demo.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page specific script -->
<script type="text/javascript">
  $('#category_table').on('click', '.btn-delete[data-remote]', function (e) { 
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
        }
    });
    var url = $(this).data('remote');
    // confirm then
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
          $.ajax({
              url: url,
              type: 'DELETE',
              dataType: 'json',
              data: {method: '_DELETE', submit: true}
          }).always(function (data) {
              $('#category_table').DataTable().draw(false);
          });
        }
    });
   
});
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('roles') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
</body>
</html>
  