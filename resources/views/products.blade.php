@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('includes.flashMsg')
            @if(!empty($products) && $products->count())
                <div class="row">
                	@foreach($products as $product)
                		<div class="col-md-4" style="margin: 10px 0px;">
                			<div class="col-md-12" style="border: 1px solid #333;padding:5px;">
                				<img class="col-md-12" src="{{ url('storage/uploads/products', $product->image) }}">
                				<h4><b>{{$product->name}}</b></h4>
                				<h5>Rs.: {{$product->price}}</h5>
                				<a href="{{ url('add-to-cart', $product->id) }}"><button class="btn btn-primary btn-add-to-cart">Add to cart</button></a>
                			</div>
                		</div>
                	@endforeach
                    {{ $products->links() }}
                </div>
            @else
            	<center>No products found.!</center>
           	@endif
        </div>
    </div>
</div>
@endsection
