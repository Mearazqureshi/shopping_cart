@extends('layouts.admin')
@section('content')
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	

	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Products</h6>
	    </div>
	    <div class="card-body">
	    	<div class="table-responsive">
	    		@include('includes.flashMsg')
                <table class="table table-bordered" id="products-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    	<th>Id</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Status</th>
						<th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
	    </div>
	</div>


	
</div>

@endsection

@section('js')
<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#products-table').DataTable( {
			stateSave: true,
			processing: true,
			serverSide: true,

			ajax: site_url+'/admin/products/get-products',
			"iDisplayLength": 10,
			"aLengthMenu": [[10, 25, 50, 100,-1], [10, 25, 50,100,"All"]],
			columns: [
				{data: 'id', name: 'id'},
			    {data: 'name', name: 'name'},
			    {data: 'quantity', name: 'quantity'},
			    {data: 'price', name: 'price'},
			    {data: 'status', name: 'status'},
			    {data: 'action', name: 'action'}
			],

		} );
	});
</script>
@stop