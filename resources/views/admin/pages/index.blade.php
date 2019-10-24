@extends('admin.layouts.master')

@section('content')
	
	<div class="main-panel">
        <div class="content-wrapper">
          <div class="card card-body">
            <h3>Welcome to your admin panel</h3>

            <p><a href="{{ route('index') }}" class="btn btn-primary btn-lg" target="_blank">Visit main site</a></p>
            
          </div>
        </div>
  </div>          
          
 
@endsection