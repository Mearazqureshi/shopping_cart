<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        if($product)
        {
            $cart = Session::get('cart', []);
            if(isset($cart[$id]))
            {
                $cart[$id]['quantity']++;
            }
            else
            {
                $cart[$id] = [
                    "name" => $product->name,
                    "image" => $product->image,
                    "price" => $product->price,
                    "quantity" => 1
                ];
            }

            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully.!');
        }
        else
        {
            return redirect()->back()->with('error', 'No such product found.!');
        }
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Removed from cart successfully.!');
    }

    public function showCart()
    {
        $carts = Session::get('cart');
        return view('cart')->with(compact('carts'));
    }

    public function cartValidation(Request $request)
    {
        $request->validate([
            'ids.*' => 'required',
            'quantity.*' => 'required|numeric|integer'
        ]);

        $cart = Session::get('cart');

        foreach($request->ids as $key => $id)
        {
            $product = Product::find($id);
            if($product->quantity < $request->quantity[$key])
            {
                return redirect()->back()->with('error', $product->name.' has only '.$product->quantity.' quantity left.');
                break;
            }
            else
            {
                $cart[$id]['quantity'] = $request->quantity[$key];
                Session::put('cart', $cart);
            }
        }

        return redirect('checkout');
    }

    public function checkout()
    {
        $cart = Session::get('cart');
        if(empty($cart))
        {
            return redirect('cart')->with('error', 'Please add some products in cart.');
        }

        return view('user.checkout');
    }
}
