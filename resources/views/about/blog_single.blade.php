@extends('layouts.main')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    
<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset("images/$post->image")}}" data-speed="0.8"></div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">{{$post->title}}</div>
					<div class="single_post_text">
            {!! $post->body !!}
          </div>
				</div>
			</div>
		</div>
	</div>

	<!-- Gallery -->
	@if (!empty($post->additional_images))	
		<div class="blog">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="gallery_slider_container">
									<div class="owl-carousel owl-theme gallery_slider">
										@forelse (explode('-', $post->additional_images) as $image)
											<div class="owl-item">
												<div class="gallery_item d-flex flex-column justify-content-center">		
													<img src="{{asset("images/$image")}}" alt="">
												</div>
											</div>
										@empty
												<p>Ничего не найдено</p>
										@endforelse
									</div>
									<!-- Brands Slider Navigation -->
									<div class="gallery_nav gallery_prev"><i class="fas fa-chevron-left"></i></div>
									<div class="gallery_nav gallery_next"><i class="fas fa-chevron-right"></i></div>
								</div>
					</div>	
				</div>
			</div>
		</div>
	@endif
  @push('scripts')
    <script src="{{asset('js/plugins/parallax-js-master/parallax.min.js')}}"></script>
    <script src="{{asset('js/blog_single_custom.js')}}"></script>
  @endpush

@endsection