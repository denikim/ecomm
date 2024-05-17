@extends('layout')
@section('side')
<div class="row justify-content-center">

<div class="col col-6">
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Products</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{route('update',$product->id)}}" enctype="multipart/form-data">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Product name</label>
          <input type="text" class="form-control"  placeholder="Enter name" name="name" value="{{$product->name}}">
        </div>
        <label for="exampleInputEmail1">Product price</label>
        <input type="text" class="form-control"  placeholder="Enter price" name="price" value="{{$product->price}}">
        </div>
        <label for="exampleInputEmail1">Product description</label>
        <input type="text" class="form-control"  placeholder="Enter description" name="details" value="{{$product->details}}">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">Product image</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFile" name="image" value="{{$product->image}}">
              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
          </div>
        </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>
  <!-- /.card -->
  @endsection
