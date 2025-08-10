<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;

        }

        table {
            border: 2px solid black;
            text-align: center;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: bold;
            background-color: black;
            
        }

        td {
            border: 1px solid skyblue;
        }
        .order_deg
        {
            padding-right: 100px;
            margin-top: -50px;
        }
        label
        {
            display: inline-block;
            width: 150px;
        }
        .div_gap
        {
            padding: 20px;

        }
    </style>


</head>

<body>
    <div class="hero_area">
        <!-- header section -->
        @include('home.header')


    </div>


    <div class="div_deg">
        <div class="order_deg">
            <form action="{{route('order.confirm')}}" method="POST">
                @csrf
                <div class="div_gap">
                    <label for="">Recever Name</label>
                    <input type="text" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="div_gap">
                    <label for="">Recever Address</label>
                    <textarea name="address" >{{Auth::user()->address}}</textarea>
                </div>
                <div class="div_gap">
                    <label for="">Recever Phone</label>
                    <input type="text" name="phone" value="{{Auth::user()->phone}}">
                </div>
                <div class="div_gap">

                    <input class="btn btn-primary" type="submit" value="Place Order">
                </div>
            </form>
        </div>

        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>
            <?php
            $value = 0;
            ?>
            @foreach ($cart as $cart)
                <tr>
                    <td>{{ $cart->product->title }}</td>
                    <td>{{ $cart->product->price }}</td>
                    <td>
                        <img width="150" src="/products/{{ $cart->product->image }}" alt="">
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('delete.cart', $cart->id) }}">Removes</a>
                    </td>
                </tr>
                <?php
                $value = $value + $cart->product->price;

                ?>
            @endforeach
        </table>
    </div>

    <div class="cart_value">
        <h3>Total value of cart is:{{ $value }}</h3>
    </div>

    @include('home.footer')

</body>

</html>
