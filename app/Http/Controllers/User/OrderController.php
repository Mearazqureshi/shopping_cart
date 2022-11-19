<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
        	'name' => 'required',
        	'phone' => 'required|integer',
        	'address' => 'required'
        ]);

		$cart_data = Session::get('cart');

		if(empty($cart_data))
        {
            return redirect('cart')->with('error', 'Please add some products in cart.');
        }

		$grand_total = 0;
		foreach($cart_data as $key => $cart)
        {
            $product = Product::find($key);
            if($cart['quantity'] <= 0)
            {
            	return redirect()->back()->with('error', 'Quantity must be greater than zero.');
                break;
            }
            else if($product->quantity < $cart['quantity'])
            {
                return redirect()->back()->with('error', 'Product '.$product->name.' has only '.$product->quantity.' left.');
                break;
            }
            else
            {
            	$cart_data[$key]['price'] = $product->price;
            	$cart_data[$key]['quantity'] = $cart['quantity'];
            	$grand_total += ($product->price * $cart['quantity']);
            }
        }

        Session::put('cart', $cart_data);
        $carts = Session::get('cart');

		$order = Order::create([
			'user_id' => Auth::user()->id,
			'name' => $request->name,
			'phone' => $request->phone,
			'address' => $request->address,
			'total' => $grand_total,
			'status' => 'done',
		]);

		$order_items = [];
		foreach($carts as $key => $cart)
        {
        	$order_items[] = [
        		'order_id' => $order->id,
        		'product_id' => $key,
        		'quantity' => $cart['quantity'],
        		'total' => ($cart['price'] * $cart['quantity']),
        		'created_at' => date('Y-m-d h:i:s'),
        		'updated_at' => date('Y-m-d h:i:s'),
        	];
        }

        OrderItem::insert($order_items);

        foreach($order_items as $order_item)
        {
        	Product::find($order_item['product_id'])->decrement('quantity', $order_item['quantity']);
        }

        unset($carts);
        Session::put('cart', []);

        return redirect('/')->with('success', 'Order has been created successfully.');
    }
     
}
