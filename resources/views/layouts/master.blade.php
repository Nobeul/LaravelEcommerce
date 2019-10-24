<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title','Laravel E-commerce')
	</title>

	@include('partials.styles')
	
</head>
<body>


	<div class="wrapper">
		<div class="container">
			{{-- Navigation bar starts here --}}
			@include('partials.nav')

			{{-- @include('partials.sidebar') --}}

			@yield('content')
		</div>

		@include('partials.footer')

	</div>
		


	<script src="{{asset('css/js/jquery-3.2.1.slim.min.js')}}"></script>
	<script src="{{asset('css/js/popper.min.js')}}"></script>
	<script src="{{asset('css/js/bootstrap.min.js')}}"></script>
</body>
</html>