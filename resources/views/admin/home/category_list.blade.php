@extends('admin.layouts.app')

@section('title') Category list  @endsection
@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <!-- general form elements -->
        <div class="row">
            <div class="col-6" >
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@if(@$category_edit) Edit @else Add @endif Category </h3>
                    <a href="{{route('category_list')}}" class="btn btn-success" style="float:right;">Add</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(@$category_edit) 
                <form action="{{route('category_update',['slug'=>$category_edit->slug])}}" method="post" role="form" enctype="multipart/form-data" >
                @else 
                <form action="{{route('category_store')}}" method="post" role="form" enctype="multipart/form-data" >
                @endif
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" name="category" id="category" value="{{@$category_edit->category}}"  placeholder="Enter category">
                        </div>
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror   
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="ckeditor" name="description" id="name="description"" placeholder="Place some text here" cols="5" rows="5" >{!! @$category_edit->description !!}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror   
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@if(@$category_edit) Edit @else Add @endif </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- general form elements end -->

        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(@$categories && $categories->count() > 0)    
                            @foreach($categories as $key => $category)
                            @php $key++; @endphp
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$category->category}}</td>
                                    <td>{!! $category->description !!}</td>
                                    <td><a href="{{ route('category_edit',['slug'=> $category->slug ])  }}" class="btn btn-info">Edit</a></td>
                                    <td><a href="{{ route('category_destroy',['slug'=> $category->slug ])  }}" class="btn btn-danger">Delete</a></td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No data available.</td>
                                </tr>
                             @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection