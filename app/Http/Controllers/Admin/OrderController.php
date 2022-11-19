<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Yajra\Datatables\Datatables;
use Storage;

class OrderController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.orders.index');
    }

    public function getOrders()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        return Datatables::of($orders)
                    ->addColumn('action', function ($order) {
                        return '<div class="btn-group">
                                <a href="'. url("admin/orders",$order->id).'" class="btn btn-primary" title="edit"><i class="fa fa-eye"></i></a>
                        </div>';
                    })
                    ->make(true);
    }

    public function showOrderDetails($id)
    {
        $order = Order::where('id', $id)->with(['items','items.product'])->first();
        return view('admin.orders.show_order_details')->with(compact('order'));
    }
}
