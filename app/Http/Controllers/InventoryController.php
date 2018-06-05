<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Validator;
class InventoryController extends Controller
{

	protected $rules = [
		'product_name' => 'required',
		'quantity_in_stock' => 'required|numeric',
		'price_per_item' => 'required|numeric'
	];
    public function show_form(){
    	$file = app_path() . '\\..\\storage\\app\\public\\inventory.json';
    	$contents = File::get($file);
    	
    	$products = json_decode($contents, true);

    	$total = 0;
    	if(count($products['products'])){
    		foreach($products['products'] as $product){
    			$total += $product['total'];
    		}
    	}

    	return view('inventory-form', ['products' => $products['products'], 'total' => $total]);
    }

    public function store(Request $request){
    	$request_all = $request->all();

    	$validator = Validator::make($request_all, $this->rules);

    	if($validator->fails()){
    		return response()->json(['result' => false, 'errors' => $validator->errors()]);
    	}

    	$data = [
    		'product_name' => $request_all['product_name'],
    		'quantity_in_stock' => $request_all['quantity_in_stock'],
    		'price_per_item' => $request_all['price_per_item'],
    		'total' => $request_all['quantity_in_stock'] * $request_all['price_per_item'],
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	];

    	$file = app_path() . '\\..\\storage\\app\\public\\inventory.json';

    	$contents = File::get($file);
    	
    	$contents = json_decode($contents, true);	

    	$last_product = count($contents['products']);

    	$last_product += 1;

    	$data['id'] = $last_product;

    	$contents['products'][] = $data;
    	
    	$json_contents = json_encode($contents);

    	File::put($file, $json_contents);

    	$response = '<table>
                    <thead>
                        <th>Product Name</th>
                        <th>Quantity In Stock</th>
                        <th>Price Per Item</th>
                        <th>Datetime submitted</th>
                        <th>Total Value Number</th>
                    </thead>';

        $file = app_path() . '\\..\\storage\\app\\public\\inventory.json';
    	$contents = File::get($file);
    	
    	$products = json_decode($contents, true);

    	$total = 0;
        foreach($products['products'] as $product){
                    $response .= "<tr>
                        <td>{$product['product_name']}</td>
                        <td>{$product['quantity_in_stock']}</td>
                        <td>{$product['price_per_item']}</td>
                        <td>{$product['created_at']}</td>
                        <td>{$product['total']}</td>
                    </tr>";
        	$total += $product['total'];
        }

        $response .= "<tr><td colspan='5'>Total: $total</td></tr>";
        $response .= '</table>';   

        return response()->json(['result' => true, 'data' => $response]);         
                    

    }
}
