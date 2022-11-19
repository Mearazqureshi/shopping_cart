@extends('layouts.admin')
@section('content')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	

	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
	    </div>
	    <div class="card-body">
	    	<div class="table-responsive">
	    		@include('includes.flashMsg')

	    		<h3 align="center"><b>Order details</b></h3>
                <table class="table" width="100%" cellspacing="0">
                    <tr>
						<th>Name</th>
						<th>{{ $order->name }}</th>
					</tr>
					<tr>
						<th>Phone</th>
						<th>{{ $order->phone }}</th>
					</tr>
					<tr>
						<th>Address</th>
						<th>{{ $order->address }}</th>
					</tr>
					<tr>
						<th>Order Date</th>
						<th>{{ date('d/m/Y', strtotime($order->created_at)) }}</th>
                    </tr>
					<tr>
						<th>Grand Total</th>
						<th>{{ $order->total }}</th>
					</tr>
                </table>

                <h3 align="center"><b>Order Items</b></h3>
                <table class="table" width="100%" cellspacing="0">
                	<tr>
	                    <th>Id</th>
						<th>Image</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
					@foreach($order->items as $order_item)
						<tr>
							<td>{{ $order_item->id }}</td>
							<td width="10%"><img src="{{ url('storage/uploads/products/', $order_item->product->image) }}" class="col-md-12" /></td>
							<td>{{ $order_item->product->name }}</td>
							<td>{{ $order_item->quantity }}</td>
							<td>{{ $order_item->total }}</td>
						</tr>
					@endforeach
                </table>
              </div>
	    </div>
	</div>


	
</div>

@endsection