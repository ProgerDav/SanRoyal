		@if (!isset($image))
			<div class="banner">
		@else
			<div class="banner pt-1 pb-1">
		@endif	
			@if(!isset($image))
				<div class="banner_background" style="background-image:url({{asset("images/banner_background.jpg")}})"></div>						
			@endif
			<div id="canvas-wrapper" class="{{isset($image) ? "container-fluid" : "container"}}">
				{{-- <div class="bg-crown" style="background-image:url({{asset("images/crown.png")}});"></div> --}}
				@if (isset($image))
					<iframe style="transform: scale(.8); height: 400px" scrolling="no" src="{{asset("js/plugins/canvas/canvas-image/index.html")}}"></iframe>
				@else	
					<iframe height="200" scrolling="no" src="{{asset("js/plugins/canvas/text-effect/index.html?txt=$text")}}"></iframe>
				@endif
			</div>
    </div>