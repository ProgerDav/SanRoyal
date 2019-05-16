    <div class="banner">
			<div class="banner_background" style="background-image:url({{asset("images/banner_background.jpg")}})"></div>
			<div id="canvas-wrapper" class="{{isset($image) ? "container-fluid" : "container"}}">
				{{-- <div class="bg-crown" style="background-image:url({{asset("images/crown.png")}});"></div> --}}
				@if (isset($image))
					<iframe height="400" style="transform: scale(1.4)" scrolling="no" src="{{asset("js/plugins/canvas/canvas-image/index.html")}}"></iframe>
				@else	
					<iframe height="200" scrolling="no" src="{{asset("js/plugins/canvas/text-effect/index.html?txt=$text")}}"></iframe>
				@endif
			</div>
    </div>