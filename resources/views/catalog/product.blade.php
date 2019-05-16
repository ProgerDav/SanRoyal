@extends('layouts.main')

@section('title')
    {{$product->name}} |
@endsection

@section('content')
  
  @include('layouts.banner', ["text" => $product->name])

  <div class="single_product">
  <div class="container">
    <div class="row">
      @php
         App\Http\Controllers\CookieController::setCookie($product->id) 
      @endphp
      <!-- Images -->
      <div class="col-lg-2 order-lg-1 order-2">
        <ul class="image_list">
          <li data-image="{{asset("images/$product->image")}}"><img src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></li>
          @if (!empty($product->additional_images))
            @forelse (explode('-', $product->additional_images) as $image)
              <li data-image="{{asset("images/$image")}}"><img src="{{asset("images/$image")}}" alt="{{$product->name}}"></li>  
              @empty
              
            @endforelse
          @endif
        </ul>
      </div>

      <!-- Selected Image -->
      <div class="col-lg-5 order-lg-2 order-1">
        <div class="image_selected"><img src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></div>
      </div>

      <!-- Description -->
      {{-- {{var_dump($properties)}} --}}
      <div class="col-lg-5 order-3">
        <div class="product_description">
          <div class="product_category">{{$subcategory->name}}</div>
          <div class="product_name">{{$product->name}}</div>
          <div class="product_text">
            <div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Описание</li>
									<li>Харакеристики</li>
								</ul>
								<div class="tabs_line"><span></span></div>
              </div>
              <div class="product_panel panel active">
                <article>{!! $product->description !!}</article>
              </div>
              <div class="product_panel panel">
                <ul class="dot-leader">
                  <li>
                    <span>Гарантия</span>
                    <span>{{$product->warranty}}</span>
                  </li>
                  <li>
                    <span>Производство</span>
                    <span>{{$product->production}}</span>
                  </li>
                  <li>
                    <span>Бренд</span>
                    <span>{{$product->brands->name}}</span>
                  </li>
                  @if (!empty($properties))
                    @forelse ($properties as $property => $value)
                      <li>
                        <span>{{$property}}</span>
                        <span>{{$value}}</span>
                      </li> 
                    @empty
                        
                    @endforelse
                  @endif
                </ul>
              </div>
            </div>  
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@push('scripts')
	<script src="{{asset('js/product_custom.js')}}"></script>    
@endpush
@endsection