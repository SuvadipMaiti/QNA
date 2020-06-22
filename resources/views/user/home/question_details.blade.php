@extends('user.layouts.app')
    @section('title') Home Page @endsection
	@section('content')
		<div id="colorlib-main">
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
	    		<div class="row d-flex">
	    			<div class="col-lg-8 px-md-5 py-5">
	    				<div class="row pt-md-4">
							<div class="col-md-12">
								<div class="blog-entry-2 ftco-animate">
									<!-- <a href="single.html" class="img" style="background-image: url(userpanel/images/image_1.jpg);"></a> -->
									<div class="text pt-4">
										<h3 class="mb-4"><a href="#">{{$question->question}}</a></h3>
										<p class="mb-4"> [ Search Tag : {{$question->slug}} ] </p>
										<p class="mb-4">{!! $question->description !!}</p>
										<div class="author mb-4 d-flex align-items-center">		
											@if(@$question->user->profile->avatar)
												<a href="#" class="img" style="background-image: url({{ $question->user->profile->avatar }});"></a>
											@else
												<a href="#" class="img" style="background-image: url(userpanel/images/person_1.jpg);"></a>
											@endif
											<div class="ml-3 info">
												<span>Written by</span>
												<h4><a href="#">{{$question->user->name}}</a>, <span>{{$question->created_at->format('jS F Y h:i:s A')}}</span></h4>
											</div>
										</div>

									</div>
								</div>
							</div>

		        <div class="pt-5 mt-5" style="overflow: auto;">
					<h3 class="mb-5 font-weight-bold">{{@$question->answers->count()}} Answers</h3>
					<div></div>
		              <ul class="comment-list">
						@if(@$question->answers()->paginate(1) && $question->answers()->paginate(1)->count() > 0)
							@foreach($question->answers()->paginate(1) as $answer)
							@if($answer->status == 1 || (@Auth::user()->id && ($answer->user_id == Auth::user()->id || $question->user_id == Auth::user()->id ) ) )
								<li class="comment">
									<div class="vcard bio">
										@if(@$answer->user->profile->avatar)
											<img src="{{$answer->user->profile->avatar}}" alt="Image placeholder">
										@else
											<img src="userpanel/images/person_1.jpg" alt="Image placeholder">
										@endif
									</div>
									<div class="comment-body">
										<h3>{{$answer->user->name}}</h3>
										<div class="meta">{{$answer->created_at->format('jS F Y h:i:s A')}}</div>
										<h4>{{$answer->answer}}</h4>
										<p>{!! $answer->description !!}</p>
										<p><a href="{{route('correct_ans_check',['slug'=>$answer->slug])}}" class="btn btn-success"><i class="icon-check"></i> ( {{$answer->checks->count()}} ) </a>
										@if(@Auth::user()->id && $answer->user_id == Auth::user()->id)
										<a href="{{route('user_ans_edit',['slug'=>$answer->slug])}}" class="btn btn-success"><i class="icon-pencil"></i> Edit </a></p>
										@endif
									</div>
								</li>
							@endif
							@endforeach
						@endif
						
					  </ul>
						<div class="row">
							<div class="col">
								<div class="block-27">
								@if(@$question->answers()->paginate(1) && $question->answers()->paginate(1)->count() > 0)
										{{ $question->answers()->paginate(1)->links() }}
								@endif
								</div>
							</div>
						</div>
		              <!-- END comment-list -->
		              
					  <div id="ansDiv" class="comment-form-wrap pt-5">
						<h3 class="mb-5">Leave a Answer </h3>
						@if(@$answer_edit)
							<form action="{{route('user_answer_edit_submit',['slug'=>$answer_edit->slug])}}" method="post" class="p-3 p-md-5 bg-light">
						@else
		                	<form action="{{route('user_answer_submit')}}" method="post" class="p-3 p-md-5 bg-light">
						@endif	
						 @csrf
						<div class="form-group">
		                    <label for="answer">Answer *</label>
		                    <input type="text" name="answer" id="answer" value="{{@$answer_edit->answer}}" class="form-control"  placeholder="Answer">
						  </div>
						  @error('answer')
								<div class="alert alert-danger">{{ $message }}</div>
							@enderror 
		                  <div class="form-group">
		                    <label for="description">Description *</label>
							<textarea name="description" id="description" class="form-control ckeditor" placeholder="Description">{{@$answer_edit->description}}</textarea>
						  </div>
						  @error('description')
								<div class="alert alert-danger">{{ $message }}</div>
						   @enderror 
		                  <div class="form-group">
		                    <label for="status">Status </label>
							<select class="form-control" name="status" id="status" data-placeholder="Select a status" style="width: 100%;">
								<option value="1"  @if(@$answer_edit && $answer_edit->status == 1 ) selected @endif >PUBLIC</option>
								<option value="0"  @if(@$answer_edit && $answer_edit->status == 0 ) selected @endif >ONLY YOU</option>
							</select> 						  
						  </div>
							@error('status')
								<div class="alert alert-danger">{{ $message }}</div>
							@enderror  
		                  <div class="form-group">
							 <input type="hidden" name="question_id" value="{{$question->id}}" > 
		                    <input type="submit" value="Submit" class="btn py-3 px-4 btn-primary">
		                  </div>
		                </form>
		              </div>
					  

		            </div>
				</div><!-- END-->

			</div>
	    	@include('user.includes.rightsidebar')
	    </section>
		</div><!-- END COLORLIB-MAIN -->
	@endsection

	@section('script')
    <!-- ckeditor -->
    <script src="{{asset('adminpanel/ckeditor/ckeditor.js')}}"></script>	
    @endsection