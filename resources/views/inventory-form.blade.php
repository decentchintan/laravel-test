<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->

</head>
<body>
    <div class="container">

        <form method="post" id="inventory-form">
            {{csrf_field()}}

            <div class="col-md-12">
                <ul class="errors">
                    
                </ul>    
            </div>

            <div class="col-md-12">
                <div class="col-md-6">
                    <label>* Product Name</label>
                    <input type="text" id="product-name" name="product_name" placeholder="Product Name" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-6">
                    <label>* Quantity In Stock</label>
                    <input type="text" id="quantity-in-stock" name="quantity_in_stock" placeholder="Quantity in stock" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-6">
                    <label>* Price Per Item</label>
                    <input type="text" id="price-per-item" name="price_per_item" placeholder="Price per item" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-md-3">
                    <button>Submit</button> 
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <h3>Inventory</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 show-inventory-here">
                @if(count($products))
                <table>
                    <thead>
                        <th>Product Name</th>
                        <th>Quantity In Stock</th>
                        <th>Price Per Item</th>
                        <th>Datetime submitted</th>
                        <th>Total Value Number</th>
                    </thead>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['quantity_in_stock']}}</td>
                        <td>{{$product['price_per_item']}}</td>
                        <td>{{$product['created_at']}}</td>
                        <td>{{$product['total']}}</td>
                    </tr>
                    @endforeach
                    <tr><td colspan="5">Total: {{$total}}</td></tr>
                </table>
                @else
                <p>No products found!</p>
                @endif
            </div>
        </div>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var token = '{{csrf_token()}}';
        var uri = '{{url('/save-inventory')}}';
    </script>
    <script src="{{asset('js/custom.js')}}"></script>
    
</body>
</html>
