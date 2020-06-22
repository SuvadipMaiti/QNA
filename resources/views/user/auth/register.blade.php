@extends('user.layouts.app')
    @section('title') Registration Form @endsection
    @section('content')
		<div id="colorlib-main">
			<section class="ftco-section contact-section px-md-4">
	      <div class="container">
	        <div class="row d-flex mb-5 contact-info">
	          <div class="col-md-12 mb-4">
	            <h2 class="h3">Registration Form</h2>
	          </div>
	        </div>
	        <div class="row block-9">
	          <div class="col-lg-6 d-flex">
	            <form action="{{route('user_register_submit')}}" method="post" class="bg-light p-5 contact-form">
                @csrf  
              <div class="form-group">
	                <input type="text" name="username" class="form-control" placeholder="User Name">
                </div>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
	              <div class="form-group">
	                <input type="email" name="email" class="form-control" placeholder="Your Email">
                </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror                 
	              <div class="form-group">
	                <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror                 
	              <div class="form-group">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
	              <div class="form-group">
	                <input type="submit" value="Sign Up" class="btn btn-primary py-3 px-5">
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	</section>
    @endsection
