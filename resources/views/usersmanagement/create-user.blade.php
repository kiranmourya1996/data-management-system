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
            <h1>Create User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create User</li>
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
                <h3 class="card-title">Create User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class='needs-validation' method="post" action="{{ route('users.store') }}">
                  {!! csrf_field() !!}
              
                <div class="card-body">
                  <div class="form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                    <label for="exampleInputFirstName">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputFirstName" placeholder="Enter first name" value="{{old('first_name')}}">
                    @if ($errors->has('first_name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                            
                  </div>
                  <div class="form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                    <label for="exampleInputLastName">Last Name</label>
                    <input type="text" name="last_name"  class="form-control" id="exampleInputLastName" value="{{old('last_name')}}" placeholder="Enter Last Name">
                    @if ($errors->has('last_name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                  </div>
                  <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
                    <label for="exampleInputEmail">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail" name="email" value="{{old('email')}}" placeholder="Enter Email">
                       @if ($errors->has('email'))
                            <span class="error-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                  </div>
                 
                 <div class="form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
                    <label for="exampleInputEmail">Password</label>
                    <input type="password" name="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="Enter password">
                     @if ($errors->has('password'))
                            <span class="error-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                  </div> 
                  <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}"">
                    <label for="exampleInputConfirmPassword">Password confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control" id="exampleInputConfirmPassword" value="{{old('password_confirmation')}}" placeholder="Enter password confirmation">
                    @if ($errors->has('password_confirmation'))
                            <span class="error-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                  </div> 
                  <div class="form-group">
                    <label for="">User Role</label>
                     <select class="form-control select2" style="width: 100%;" name="role">
                        @if ($roles)
                        <option value="">Select role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif
                      </select>
                       @if ($errors->has('role'))
                         <span class="error-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
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
