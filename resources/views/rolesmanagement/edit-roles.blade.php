<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAMe')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('vendors/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('vendors/dist/css/adminlte.min.css')}}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
            <h1>Update Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class='needs-validation' method="post" action="{{ route('roles.update',$roles->id) }}">
                {{ csrf_field() }}
                {{ method_field('put') }}
              
                <div class="card-body">
                  <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
                    <label for="exampleInputName"> Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name" value="{{$roles->name}}">
                    @if ($errors->has('name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                            
                  </div>
                   <div class="form-group">
                    <label for="">Permission</label>
                      <div class="form-check">
                         @if ($permission)
                          @foreach($permission as $permisions)

                          <input class="form-check-input" type="checkbox" name="permisions[]" value="{{$permisions->id}}" id="flexCheckDefault" multiple=""  @if(isset($permissionrole) && in_array($permisions->id, $permissionrole))checked="checked" @endif>
                          <label class="form-check-label" for="flexCheckDefault">
                            {{$permisions->name}}
                          </label><br>
                           @endforeach
                        @endif
                      </div>
                   </div> 
                 
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('common.footer');

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('vendors/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendors/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('vendors/dist/js/demo.js"></script>

<!-- Page specific script -->

</body>
</html>
