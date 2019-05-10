@extends('layouts.main')

@section('title')
    Бренды | 
@endsection

@section('content')
    
  @include('layouts.banner', ['text' => 'Бренды'])

  <div class="shop">
		<div class="container">
			<div class="row">
        <div class="col-lg-3">
          @include('layouts.sidebar')
        </div>

        <div class="col-lg-9">
          {{-- Content --}}
          <div class="shop_content">
            <div class="shop_bar clearfix">
              <div class="shop_product_count"><span>{{$brands->count()}}</span> найдено</div>
              <!-- <div class="shop_sorting">
                <span>Sort by:</span>
                <ul>
                  <li>
                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                    <ul>
                      <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated
                      </li>
                      <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                      <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>price</li>
                    </ul>
                  </li>
                </ul>
              </div> -->
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
              <div class="product_grid_border"></div>
                  @forelse ($brands as $brand)
                          <div class="product_item brand-item">
                            <div class="product_border"></div>
                            <a href="{{route("brands.single", ['slug' => Str::slug($brand->id.' '.$brand->slug)])}}" class="product_image d-flex flex-column align-items-center justify-content-center">
                              <img src="{{asset("images/$brand->image")}}" alt="{{$brand->name}}">
                            </a>
                            <div class="product_content">
                              <div class="product_name">
                                <div><a href="{{route("brands.single", ['slug' => Str::slug($brand->id.' '.$brand->slug)])}}">{{$brand->name}}</a></div>
                              </div>
                            </div>
                          </div>
                  @empty
                      <p>Ничего не найдено</p>
                  @endforelse
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection