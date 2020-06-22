@extends('user.layouts.app')
    @section('title') Profile @endsection
	@section('content')
	<div id="colorlib-main">
		<section class="ftco-section contact-section px-md-4">
	      <div class="container">
	        <div class="row d-flex mb-5 contact-info">
	          <div class="col-md-12 mb-4">
	            <h2 class="h3">Profile Update</h2>
	          </div>
	          <div class="w-100"></div>
	          <div class="col-lg-6 col-xl-3 d-flex mb-4">
	          	<div class="info bg-light p-4">
		            <p><span>Address:</span><br>{{@$user->profile->address}}<br>{{@$user->profile->city}}<br>{{@$user->profile->country}}<br>{{@$user->profile->pin}}</p>
		          </div>
	          </div>
	          <div class="col-lg-6 col-xl-3 d-flex mb-4">
	          	<div class="info bg-light p-4">
		            <p><span>Phone:</span> <a href="tel://{{@$user->profile->mobile}}"><br>{{@$user->profile->mobile}}</a></p>
		          </div>
	          </div>
	          <div class="col-lg-6 col-xl-3 d-flex mb-4">
	          	<div class="info bg-light p-4">
		            <p><span>Email:</span> <a href="mailto:{{@$user->profile->email}}"><br>{{@$user->email}}</a></p>
		          </div>
	          </div>
	          <div class="col-lg-6 col-xl-3 d-flex mb-4">
	          	<div class="info bg-light p-4">
		            <p><span>Websites</span> <a href="#"><br>{{@$user->profile->facebook}}<br>
					{{@$user->profile->youtube}}<br>{{@$user->profile->twitter}}<br>
					{{@$user->profile->linkdin}}<br>{{@$user->profile->google}}<br>
					{{@$user->profile->instagram}}</a></p>
		          </div>
	          </div>
	        </div>
	        <div class="row d-flex mb-5 contact-info">
	          <div class="col-md-12 mb-4">
	            <h2 class="h3"></h2>
	          </div>
	          <div class="w-100"></div>
	          <div class="col-lg-6 col-xl-6 d-flex mb-4">
	          	<div class="info imageDiv bg-light p-4">
				  	@if(@$user->profile->avatar)
					  <img src="{{ $user->profile->avatar }}" alt="User Avatar" class="img-size-50 img-circle mr-3">					
					  @else
					  <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">					
					  @endif
		          </div>
	          </div>
	          <div class="col-lg-6 col-xl-6 d-flex mb-4">
	          	<div class="info bg-light p-4">
		            <p> {!! @$user->profile->about !!}</p>
		          </div>
	          </div>
	        </div>			
	        <div class="row block-9">
	          <div class="col-lg-6 d-flex">
	            <form action="{{route('user_profile_update')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data" >
				  @csrf
	              <div class="form-group">
	                <input type="text" class="form-control" name="username" value="{{@$user->name}}" placeholder="Username" readonly >
	              </div>
				  @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror   
	              <div class="form-group">
	                <input type="text" class="form-control" name="email" value="{{@$user->email}}"  placeholder="Your Email" readonly >
	              </div>
				  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror 				  
	              <div class="form-group">
	                <input type="text" class="form-control" name="mobile" value="{{@$user->profile->mobile}}" placeholder="Mobile">
	              </div>				  
	              <div class="form-group">
	                <input type="text" class="form-control" name="city" value="{{@$user->profile->city}}" placeholder="City">
	              </div>				  
	              <div class="form-group">
	                <input type="text" class="form-control" name="country" value="{{@$user->profile->country}}" placeholder="Country">
	              </div>				  
	              <div class="form-group">
	                <input type="text" class="form-control" name="pin" value="{{@$user->profile->pin}}" placeholder="Pin">
	              </div>				  				  				  				  						  			  
	              <div class="form-group">
	                <textarea name="address" id="address" cols="30" rows="7" class="form-control"  placeholder="Address">{{@$user->profile->address}}</textarea>
	              </div>				  
	              <div class="form-group">
	                <input type="file" class="form-control" name="avatar" value="{{@$user->profile->avatar}}" placeholder="Avatar">
	              </div>				  				  
	              <div class="form-group">
	                <textarea name="about" id="about" cols="30" rows="7" class="form-control ckeditor" placeholder="About">{!! @$user->profile->about !!}</textarea>
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" name="facebook" value="{{@$user->profile->facebook}}" placeholder="facebook">
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" name="youtube" value="{{@$user->profile->youtube}}" placeholder="youtube">
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" name="twitter" value="{{@$user->profile->twitter}}" placeholder="twitter">
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" name="linkdin" value="{{@$user->profile->linkdin}}" placeholder="linkdin">
	              </div>
	              <div class="form-group">
	                <input type="text" class="form-control" name="google" value="{{@$user->profile->google}}" placeholder="google">
	              </div>	
	              <div class="form-group">
	                <input type="text" class="form-control" name="instagram" value="{{@$user->profile->instagram}}" placeholder="instagram">
	              </div>				  			  				  				  				  				  				  
	              <div class="form-group">
	                <input type="submit" value="Update" class="btn btn-primary py-3 px-5">
	              </div>
	            </form>
	          </div>

	          <div class="col-lg-6 d-flex">
	          	<div id="map" class="bg-light"></div>
	          </div>
	        </div>
	      </div>
		</section>
    </div><!-- END COLORLIB-MAIN -->
		@section('script')
			<!-- ckeditor -->
		<script src="{{asset('adminpanel/ckeditor/ckeditor.js')}}"></script>	
		@endsection
    @endsection
