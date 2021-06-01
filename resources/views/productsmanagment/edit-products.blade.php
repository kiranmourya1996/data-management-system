<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAME')}}</title>

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
            <h1>Update Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Product</li>
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
                <h3 class="card-title">Update Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class='needs-validation' method="post" action="{{ route('products.update',$products->id) }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                {{ method_field('put') }}
              
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Select category</label>
                     <select class="form-control select2" style="width: 100%;" name="category_id">
                        @if ($categories)
                        <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $products->id ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        @endif
                      </select>
                       @if ($errors->has('category'))
                         <span class="error-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                  </div> 
                  <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
                    <label for="exampleInputName"> Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name" value="{{$products->name}}">
                    @if ($errors->has('name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                            
                  </div>
                  <div class="form-group {{ $errors->has('description') ? ' has-error ' : '' }}">
                    <label for="exampleInputdescription">Description</label>
                    <textarea type="text" name="description"  class="form-control" id="exampleInputdescription" value="{{old('description')}}" placeholder="Enter description">{{$products->description}}</textarea>
                    @if ($errors->has('description'))
                            <span class="error-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                  </div>
                  <div class="form-group {{ $errors->has('price') ? ' has-error ' : '' }}">
                    <label for="exampleInputPrice"> Price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputPrice" placeholder="Enter price" value="{{$products->price}}">
                    @if ($errors->has('price'))
                            <span class="error-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                            
                  </div>
                   <div class="form-group {{ $errors->has('image') ? ' has-error ' : '' }}">
                    <label for="exampleInputImage"> Image</label>
                     
                      <input type="file" id="fileUpload" data-max-size="10240" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg"/>
                      <img src="{{$products->image}}" id="imgPrime" height="100" width="100" style="    margin-top: 10px;">
                                    
                    @if ($errors->has('image'))
                            <span class="error-block">
                                <strong>{{ $errors->first('image') }}</strong>
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
<script src="{{asset('vendors/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('vendors/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendors/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('vendors/dist/js/demo.js"></script>
<script type="text/javascript">
    $(document).on('change', '#fileUpload', function(){

      var input = this;
      var url = $(this).val();
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
       {
          var reader = new FileReader();

          reader.onload = function (e) {
           
             $('#imgPrime').attr('src', e.target.result);
          }
         reader.readAsDataURL(input.files[0]);
      }
});
</script>

<!-- Page specific script -->

</body>
</html>
