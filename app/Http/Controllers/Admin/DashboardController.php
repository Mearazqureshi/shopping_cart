<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = OrderItem::selectRaw('SUM(order_items.quantity) as product_sell_count, order_items.product_id')->with(['product'])->groupBy('product_id')->orderBy('product_sell_count','desc')->limit(10)->get();

        return view('admin.dashboard')->with(compact('orders'));
    }
     
}
