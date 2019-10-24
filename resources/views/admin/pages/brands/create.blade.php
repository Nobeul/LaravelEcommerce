@extends('admin.layouts.master')

@section('content')
  <div class="main-panel">
    <div class="content-wrapper">

      <div class="card">
        <div class="card-header">
          Add brand
        </div>
        <div class="card-body">
          <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('admin.partials.messages')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter brand name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description(optional)</label>
              <textarea name="description" rows="8" cols="80" class="form-control"></textarea>

            </div>
            
            
            
            <div class="form-group">
              <label for="image">brand Image(optional)</label>

              <input type="file" class="form-control" name="image" id="image" >
            
            </div>

            <button type="submit" class="btn btn-primary">Add brand</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- main-panel ends -->
@endsection