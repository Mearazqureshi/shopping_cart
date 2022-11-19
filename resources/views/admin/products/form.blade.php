@csrf
<div class="form-group col-md-6">
	<label for="">Name</label>
	<input name="name" type="text" class="form-control" value="{{ (isset($product))? $product->name : old('name') }}" placeholder="Enter Name">
	@error('name')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="form-group col-md-6">
	<label for="">Quantity</label>
	<input name="quantity" type="text" class="form-control" value="{{ (isset($product))? $product->quantity : old('quantity') }}" placeholder="Enter Quantity">
	@error('quantity')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="form-group col-md-6">
	<label for="">Price</label>
	<input name="price" type="text" class="form-control" value="{{ (isset($product))? $product->price : old('price') }}" placeholder="Enter Price">
	@error('price')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="form-group col-md-6">
	<label for="">Image</label>
	<input name="image" type="file" class="form-control">
	@error('image')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="form-group col-md-6">
	<label for="">Status</label>
	<select name="status" class="form-control">
		<option value="active">Active</option>
		<option value="inactive">In Active</option>
	</select>
	@error('status')
	    <div class="alert alert-danger">{{ $message }}</div>
	@enderror
</div>

<div class="row" style="margin-left: 0px; margin-bottom: 20px;">
	<!-- <label for="">Images</label> -->
	@if((isset($product)) && $product->image)
		<h3 class="col-md-12">Image</h3>
		<div class="col-md-3">
			<div class="card" style="">
				<a href="{{ asset('storage/uploads/products/'.$product->image)  }}" target="_blank">

				  <img class="card-img-top" src="{{ asset('storage/uploads/products/'.$product->image)  }}" alt="Card image cap" width="150px" height="150px;">
				</a>
			  
			</div>
		</div>
	@endif
</div>

<div class="form-group col-md-6">
	<button type="submit" class="btn btn-primary">Submit</button>
</div>