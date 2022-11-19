@extends('layouts.admin')

@section('content')

<style type="text/css">
	
	@media (min-width: 992px){
		.row {
		min-height: 578px;
		}
	}
</style>
 <!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-4 col-lg-12 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>

                  <form class="user" method="POST" action="{{ route('adminLogin') }}">
                  	@csrf
                  	@include('includes.flashMsg')
                    <div class="form-group" >
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Enter Email Address..."  value="{{ old('email') }}">
                      	  @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
          						@error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                        
                        <button type="submit" class="btn btn-primary btn-user btn-block">
          						Login
          					</button>
          
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
</div>
<!-- /.container-fluid -->

@endsection