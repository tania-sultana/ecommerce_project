<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            @include('admin.body')
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('assets/admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('assets/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('assets/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('assets/admincss/js/front.js')}}"></script>
  </body>
</html>
