@extends('layouts.admin')
@section('content')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	

	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Top 10 Selling products</h6>
	    </div>
	    <div class="card-body">
	    	<div class="table-responsive">
	    		@include('includes.flashMsg')
                <table class="table" width="100%" cellspacing="0">
                	<tr>
	                    <th>Id</th>
						<th>Image</th>
						<th>Product</th>
						<th>Sold Quantity</th>
					</tr>
					@php $i=1; @endphp
					@foreach($orders as $order)
						<tr>
							<td>{{ $i++ }}</td>
							<td width="10%"><img src="{{ url('storage/uploads/products/', $order->product->image) }}" class="col-md-12" /></td>
							<td>{{ $order->product->name }}</td>
							<td>{{ $order->product_sell_count }}</td>
						</tr>
					@endforeach
                </table>
              </div>
	    </div>
	</div>


	
</div>

@endsection