@extends('layouts.admin')

@section('content')

<div class="container-fluid">
	

	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
	    </div>
	    <div class="card-body">
	    	@include('includes.flashMsg')
	    	<form method="POST" action="{{ url('admin/products/'.$product->id)}}" enctype="multipart/form-data">
	    		@method('PATCH')
	    		@include('admin.products.form')
	    	</form>
	    </div>
	  </div>

	
</div>

@endsection