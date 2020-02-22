@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add Product
        </div>
        <div class="card-body">
          <form action="{{ route('admin.product.store') }}" method="post" id="form-id" enctype="multipart/form-data">
            @csrf
            @include('admin.partials.messages')
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" class="form-control" name="title" id="productTitle" aria-describedby="emailHelp" placeholder="Enter title">
              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea name="description" id="description" rows="8" cols="80" class="form-control"></textarea>

            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Price</label>
              <input type="number" class="form-control" name="price" id="price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Select Category</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">Please select a category for the product</option>

                @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $parent)
                <option value="{{$parent->id}}">{{$parent->name}}</option>
                    @foreach (App\Category::orderBy('name', 'asc')->where('parent_id', NULL)->get() as $child)
                    <option value="{{$child->id}}">--->{{$child->name}}</option>
                    @endforeach
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Select Brand</label>
              <select class="form-control" name="brand_id">
                <option value="">Please select a brand for the product</option>

                @foreach (App\Brand::orderBy('name', 'asc')->get() as $brand)
                <option value="{{$brand->id}}">{{$brand->name}}</option>
                    
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="product_image">Product Image</label>

              <div class="row">
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image" id="product_image" >
                </div>
                <!-- <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
                <div class="col-md-4">
                  <input type="file" class="form-control" name="product_image[]" id="product_image" >
                </div>
              </div> -->
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top:8px">Add Product</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script>
$('#form-id').validate({
  rules:{
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        title: {required:true},
        description: {required:true},
        price: {required:true},
        quantity: {required:true},
        parent_id: {required:true},
        product_image: {required:true}
      },

  });

  $(document).ready(function() {       
    $('#product_image').bind('change', function() {
        var a=(this.files[0].size);

        if(a > 500000) {
            alert('Image is too large. Please use image less than 500kb');
        };
    });
  });


// For quantity validation
  $("#quantity").inputFilter(function(value) {
    var regex = /[0-9]{1,9}/;
    return regex.test(value);    // Allow digits only, using a RegExp
  });

  $( "#price" ).validate({
  rules: {
    field: {
      required: true,
      number: true
      }
    }
  });
</script>

@endsection