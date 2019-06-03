@extends('layouts.main')

@section('title')
    {{$brand->name ?? "Не Найдено"}} | 
@endsection

@section('content')
    
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
              <div class="shop_product_count"></div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
            <div class="product_grid_border"></div> 
              <div class="row single_item">
                <article class="col-lg-9 single_item_text">
                  <h3 class="single_item_title">{{$brand->name}}</h3>
                  <p>
                    {!! $brand->description !!}
                  </p>
                    {{-- <ul class="col-lg-6 col-xs-12 col-sm-12">
                      @forelse ($available_categories as $category) 
                        <li>
                          <a href="{{route("catalog.category", ['category_slug' => Str::slug($category->id.' '.$category->slug)])}}">{{$category->name}}</a>
                          <ul style="padding-left: 20px">
                            @forelse ($category->subcategories as $subcat)
                              <li><a href="{{route("catalog.subcategory", ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($subcat->id.' '.$subcat->slug)])}}">{{$subcat->name}}</a></li>
                              @empty
                            @endforelse
                          </ul>
                        </li>  
                        @empty
                      @endforelse
                    </ul> --}}
                    <ul class="d-flex flex-wrap mt-4">
                      @forelse ($categories as $cat)
                          <li class="col-lg-6 d-flex">
														<div class="col-lg-3">
															<img class="cat_menu_image" src="{{asset("images/$cat->image")}}" alt="{{$cat->name}}">
														</div>
														<div class="col-lg-9">
															<a class="product_name" href="{{route('catalog.category', ['category_slug' => Str::slug($cat->id.' '.$cat->slug)])}}" title="{{$cat->name}}">
																{{$cat->name}}
															</a>
															<ul>
																@forelse ($cat->subcategories as $subcat)
																	<li>
																		<a href="{{route('catalog.subcategory', ['category_slug' => Str::slug($cat->slug), 'subcategory_slug' => Str::slug($subcat->id.' '.$subcat->slug)])}}" title="{{$subcat->name}}">{{$subcat->name}}</a>
																	</li>	
																@empty
																		
																@endforelse
															</ul>
														</div>
													</li>
                      @empty

                      @endforelse
                    </ul>
                </article>  
                <div class="col-lg-3">
                  <img src="{{asset("images/".$brand->image)}}" alt="{{$brand->name}}" class="single_item_img_responsive" />
                </div>
              </div>       
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection