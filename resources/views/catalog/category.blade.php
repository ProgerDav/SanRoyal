@extends('layouts.main')

@section('title')
    {{$category->name ?? 'Не найдено'}} |
@endsection

@section('content')
  
  @include('layouts.banner', ["text" => $category->name])

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
              <div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <a href="{{route("catalog.index")}}">Каталог</a> > <span>{{$category->name}}</span> | <span>{{$subcategories->count()}}</span> найдено</div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
              <div class="product_grid_border"></div>
                  @forelse ($subcategories as $subcategory)
                          <div class="product_item category-item">
                            <div class="product_border"></div>
                            <div class="row align-items-center justify-content-center">
                              <a style="height: auto" href="{{route("catalog.subcategory", ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($subcategory->id.' '.$subcategory->slug)])}}" class="col-lg-5 text-center  product_image">
                                <img src="{{asset("images/$subcategory->image")}}" alt="{{$category->name}}">
                              </a>
                              <div class="product_content col-lg-6">
                                <div class="product_name">
                                  <a href="{{route("catalog.subcategory", ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($subcategory->id.' '.$subcategory->slug)])}}" tabindex="0">{{$subcategory->name}}</a>
                                </div>
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