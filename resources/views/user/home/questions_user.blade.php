@extends('user.layouts.app')
    @section('title') Home Page @endsection
	@section('content')
	<div id="colorlib-main">
		<section class="ftco-section contact-section px-md-4">
	    	<div class="container">
	    		<div class="row d-flex">
	    			<div class="col-xl-8 py-5 px-md-5">
	    				<div class="row pt-md-4">
							@if(@$questions && $questions->count() > 0)
								@foreach($questions as $question)
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
													<h6><a href="#"><i class="icon-folder-o mr-2"></i> Category</a> : 
														<span>
														@if(@$question->categories && $question->categories->count() > 0)
															@foreach($question->categories as $category)
																<a href="#">{{$category->category}} <span>({{$category->questions->count()}})</span></a>
															@endforeach
														@endif
														</span>
                                                    </h6>
                                                    <h6><a href="#"><i class="icon-folder-o mr-2"></i> Tag</a> : 
														<span>
														@if(@$question->tags && $question->tags->count() > 0)
															@foreach($question->tags as $tag)
																<a href="#">{{$tag->tag}} <span>({{$tag->questions->count()}})</span></a>
															@endforeach
														@endif
														</span>
													</h6>
												</div>
											</div>
											<div class="meta-wrap d-md-flex align-items-center">
												<div class="half order-md-last text-md-right">
													<p class="meta">
                                                        <span><i class="icon-check"></i>
														
														@php
														$check = 0;
														foreach($question->answers as $answer)
														{
															$check+= $answer->checks->count();
														}
														echo $check;
														@endphp
		
														</span>
														<span><i class="icon-eye"></i>{{@$question->visitors->count()}}</span>
														<span><i class="icon-comment"></i>{{@$question->answers->count()}}</span>
													</p>
												</div>
												<div class="half">
													<p><a href="{{route('user_question',['slug'=>$question->slug])}}" class="btn btn-primary p-3 px-xl-4 py-xl-3">Answers ( {{@$question->answers->count()}} )</a></p>
                                                </div>												
                                                <div class="half">
													<p><a href="{{route('user_question_edit',['slug'=>$question->slug])}}" class="btn btn-warning p-3 px-xl-4 py-xl-3"><i class="icon-pencil"></i> Edit </a></p>
                                                </div>                                                                                               
											</div>
										</div>
									</div>
								</div>
								@endforeach
							@endif
			    		</div><!-- END-->
			    		<div class="row">
			          <div class="col">
			            <div class="block-27">
						@if(@$questions && $questions->count() > 0)
								{{ $questions->links() }}
						@endif
			            </div>
			          </div>
			        </div>
				</div>
				@include('user.includes.rightsidebar')
			</div>
		</section>

	    @endsection