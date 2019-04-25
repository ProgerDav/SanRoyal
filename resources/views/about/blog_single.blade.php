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

	<!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

            @forelse ($related as $item)
              <div class="blog_post">
                <div class="blog_image" style="background-image:url({{asset("images/$item->image")}})"></div>
                <div class="blog_text">{{$item->title}}</div>
                <div class="blog_button"><a href="{{route('about.blog_single', ['post_slug' => Str::slug($item->id.' '.$item->title)])}}">Читать дальше</a></div>
              </div>
            @empty
                
            @endforelse
            
					</div>
				</div>	
			</div>
		</div>
	</div>

  @push('scripts')
    <script src="{{asset('js/plugins/parallax-js-master/parallax.min.js')}}"></script>
    <script src="{{asset('js/blog_single_custom.js')}}"></script>
  @endpush

@endsection