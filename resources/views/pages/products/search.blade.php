{{-- For all the products --}}
@extends('layouts.master')

@section('content')

	{{-- Sidebar starts here --}}
		<div class="row margin-top-20">
			<div class="col-md-3">
				@include('partials.product-sidebar')
			</div>
			
			<div class="col-md-9">
				<div class="widget">
					<h3>
						Searched products for -
						<span class="badge badge-primary">
							{{ $search}}
						</span>
					</h3>
					<hr>
					
					@include('pages.products.partials.all_products')
					

				</div>
			</div>
			{{-- Content ends here --}}
		</div>
		{{-- Sidebar+content ends here --}}



@endsection