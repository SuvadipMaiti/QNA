@extends('user.layouts.app')
    @section('title') @if(@$question_edit) Edit @else Ask a  @endif  Question @endsection

    @section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminpanel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    @endsection

    @section('content')
    <div id="colorlib-main">
		<section class="ftco-section contact-section px-md-4">
	      <div class="container">
	        <div class="row d-flex mb-5 contact-info">
	          <div class="col-md-12 mb-4">
	            <h2 class="h3">@if(@$question_edit) Edit @else Ask a  @endif Question</h2>
	          </div>
	        </div>
	        <div class="row block-9">
	          <div class="col-lg-12 d-flex">
              @if(@$question_edit) 
              <form action="{{route('user_edit_question',['slug'=>$question_edit->slug])}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data" >  
              @else 
              <form action="{{route('user_submit_question')}}" method="post" class="bg-light p-5 contact-form" enctype="multipart/form-data" >
              @endif
                @csrf  
              <div class="form-group">
                <select class="select2 form-control" name="category[]" id="category" multiple="multiple" data-placeholder="Select category" style="width: 100%;">
                    @if(@$categories)
                    @foreach($categories as $category)
                    <option value="{{$category->id}}"
                        @if(@$question_edit->categories)
                            @foreach($question_edit->categories as $cat)
                                @if($cat->id == $category->id)
                                    selected
                                @endif
                            @endforeach
                        @endif
                    >{{$category->category}}</option>
                    @endforeach
                    @endif
                </select>
                </div>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
	              <div class="form-group">
                    <select class="select2 form-control" name="tag[]" id="tag" multiple="multiple" data-placeholder="Select tag" style="width: 100%;">
                        @if(@$tags)
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}"
                            @if(@$question_edit->tags)
                                @foreach($question_edit->tags as $t)
                                    @if($t->id == $tag->id)
                                        selected
                                    @endif
                                @endforeach
                            @endif
                        >{{$tag->tag}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                @error('tag')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror                 
	              <div class="form-group">
	                <input type="text" name="question" value="{{@$question_edit->question}}" class="form-control" placeholder="Ask a Question">
                </div>
                @error('question')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror                 
	              <div class="form-group">
                  <textarea name="description" id="description" class="form-control ckeditor" placeholder="Description">{!! @$question_edit->description !!}</textarea>
                </div>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror 
                <div class="form-group">
                    <select class="form-control" name="status" id="status" data-placeholder="Select a status" style="width: 100%;">
                        <option value="1" @if(@$question_edit && $question_edit->status == 1 ) selected @endif >PUBLIC</option>
                        <option value="0" @if(@$question_edit && $question_edit->status == 0 ) selected @endif >ONLY ME</option>
                    </select>                
                </div>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror                 

	              <div class="form-group">
	                <input type="submit" value="Submit" class="btn btn-primary py-3 px-5">
	              </div>
	            </form>
	          </div>
	        </div>
          </div>
        </div>
	</section>
    @endsection

    @section('script')
    <!-- ckeditor -->
    <script src="{{asset('adminpanel/ckeditor/ckeditor.js')}}"></script>	
    <!-- Select2 -->
    <script src="{{asset('adminpanel/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
    </script>
    @endsection