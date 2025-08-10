<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
        table{
            border: 2px solid skyblue;
            text-align: center;
        }
        th
        {
            background-color: skyblue;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: white
        }
        td{
            color: white;
            padding: 10px;
            border:1px solid skyblue;
        }
        .table
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <div class="table_center">
            <table>
            <tr>
                <th>Customer name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product title</th>
                <th>price</th>
                <th>Image</th>
                <th>Status</th>
            </tr>
            @foreach($data as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->rec_address}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->product->title}}</td>
                <td>{{$data->product->price}}</td>
                <td>
                    <img width="150" src="products/{{$data->product->image}}" alt="">
                </td>
                <td>{{$data->status}}</td>
            </tr>
            @endforeach
          </table>
          </div>
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>
