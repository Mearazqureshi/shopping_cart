@extends('layouts/app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@include('includes.flashMsg')
			<h3><center>Checkout</center></h3>

			<form method="post" action="{{ route('order') }}">
				@csrf
				@php $user = Auth::user(); @endphp
				<div class="form-group col-md-6">
					<label for="">Name</label>
					<input name="name" type="text" class="form-control" value="{{ (isset($user->name))? $user->name : old('name') }}" placeholder="Enter Name">
					@error('name')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group col-md-6">
					<label for="">Phone</label>
					<input name="phone" type="number" class="form-control" value="{{ old('phone') }}" placeholder="Enter Phone">
					@error('phone')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group col-md-6">
					<label for="">Address</label>
					<textarea name="address" class="form-control">{{ old('address') }}</textarea>
					@error('address')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>

				<div class="form-group col-md-6">
					<button type="submit" class="btn btn-primary">Place an order</button>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection