@extends('layouts.main')

@section('title')
    Новости | 
@endsection

@section('content')
    
  @include('layouts.banner', ['text' => "Новости"])

  <div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						
					@forelse ($posts as $post)
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset("images/$post->image")}})"></div>
							<div class="blog_text">{{$post->title}}</div>
							<div class="blog_button"><a href="{{route("about.blog_single", ['post_slug' => Str::slug($post->id.' '.$post->title)])}}">Читать дальше</a></div>
            </div>
          @empty
              <h4>Ничего не найдено</h4>
          @endforelse
						
					</div>
				</div>
					
			</div>
		</div>
	</div>

@endsection