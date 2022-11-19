@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.flashMsg')
            @if(isset($carts) && count($carts))
            	@php $i = 1; $grand_total=0; @endphp
            	<form id="cart_form" method="post" action="{{ url('cart-validation') }}">
            	@csrf

	            	<table class="table table-border">
	            		<thead>
	            			<tr>
	            				<th>Sr.</th>
	            				<th>Image</th>
	            				<th>Name</th>
	            				<th>Quantity</th>
	            				<th>Price</th>
	            				<th>Total</th>
	            				<th>Action</th>
	            			</tr>
	            		</thead>
	            		<tbody>
			            	@foreach($carts as $key => $cart)
			            		@php $grand_total += ($cart['price'] * $cart['quantity']); @endphp
			            		<tr class="cart-row">
			            			<td>{{ $i++ }}</td>
			            			<td width="10%"><img class="col-md-12" src="{{ url('storage/uploads/products',$cart['image']) }}" /></td>
			            			<td>{{ $cart['name'] }}</td>
			            			<td>
			            				<input type="hidden" name="ids[]" value="{{ $key }}">
			            				<input type="number" name="quantity[]" class="form-controller cart-quantity"  value="{{ $cart['quantity'] }}"min="1"><br>
			            				@error('quantity.*')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
			            				<div class="col-md-12 error text-danger"></div>
			            			</td>
			            			<td class="cart-price" data-price="{{ $cart['price'] }}">{{ $cart['price'] }}</td>
			            			<td class="cart-row-total">{{ ($cart['price'] * $cart['quantity']) }}</td>
			            			<td><a href="{{ url('remove-from-cart', $key) }}"><button type="button" class="btn btn-danger">Delete</button></a></td>
			            		</tr>	
			            	@endforeach
		            	</tbody>
		            	<tfoot>
		            		<tr>
		            			<td colspan="5" align="center"><b>Grand Total</b></td>
		            			<td colspan="2" id="grand_total">{{ $grand_total }}</td>
		            		</tr>
		            	</tfoot>
	            	</table>

	            	<div class="col-md-12">
	            		<button type="submit" class="btn btn-primary btn-checkout col-md-2 pull-right">Checkout</button>
	            	</div>

            	</form>

            @else
            	<center>Your Cart is empty.!</center>
           	@endif
        </div>
    </div>
</div>
@endsection

@section('js')
	<script>
		$(document).on('keyup change', '.cart-quantity', function(){
			var grand_total = 0;
			var quantity = $(this).val();
			var price = $(this).closest('.cart-row').find('.cart-price').data('price');

			$(this).closest('.cart-row').find('.cart-row-total').html(quantity * price);

			$(".cart-row").each(function() {
				var quantity = $(this).find('.cart-quantity').val();
				var price = $(this).find('.cart-price').data('price');

				grand_total+= (quantity * price);
			});

			$('#grand_total').html(grand_total);
		});

		$(document).on('click','.btn-checkout', validation);

		function validation(e)
		{
			e.preventDefault();
			var flag = 0;
			$(".cart-row").each(function() {
				var quantity = $(this).find('.cart-quantity').val();

				if(quantity > 0 && (quantity % 1 === 0))
				{
					$(this).find('.error').html('');
				}
				else
				{
					flag = 1;
					$(this).find('.error').html('Please enter valid quantity');
					return false;
				}

			});

			if(flag == 0)
			{
				$('#cart_form').submit();
			}

			// if(flag == 0)
			// {
			// 	var url = "{{ url('/') }}";
			// 	var token = "{{ csrf_token() }}";

			// 	$(".cart-row").each(function() {

			// 	});

			// 	$.ajax({
			// 		method: 'post',
			// 		url: url + 'cart-validation',
			// 		data: { _token : token, },
			// 		success: function(response)
			// 		{
			// 			var response = $.parseJson(response);
			// 			if(response.status == 1)
			// 			{
			// 				window.location.href = url + "/checkout";
			// 			}
			// 		},
			// 		error: function(){
			// 			alert('Something went wrong, please try again later');
			// 		}
			// 	});
			// }
			// else
			// {
			// 	alert('Something went wrong, please try again later');
			// }
		}

	</script>
@endsection