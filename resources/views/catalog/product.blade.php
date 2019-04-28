@extends('layouts.main')

@section('title')
    {{$product->name}}
@endsection

@section('content')
  
  @include('layouts.banner', ["text" => $product->name])

  <div class="single_product">
  <div class="container">
    <div class="row">
      {{-- {{var_dump($arr)}} --}}
      <!-- Images -->
      <div class="col-lg-2 order-lg-1 order-2">
        <ul class="image_list">
          <li data-image="{{asset("images/$product->image")}}"><img src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></li>
          @foreach (explode('-', $product->additional_images) as $image)
            <li data-image="{{asset("images/$image")}}"><img src="{{asset("images/$image")}}" alt="{{$product->name}}"></li>   
          @endforeach
        </ul>
      </div>

      <!-- Selected Image -->
      <div class="col-lg-5 order-lg-2 order-1">
        <div class="image_selected"><img src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></div>
      </div>

      <!-- Description -->
      <div class="col-lg-5 order-3">
        <div class="product_description">
          <div class="product_category">{{$subcategory->name}}</div>
          <div class="product_name">{{$product->name}}</div>
          {{-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div> --}}
          <div class="product_text">
            <p>{!! $product->description !!}</p>
          </div>
          <div class="order_info d-flex flex-row">
            
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