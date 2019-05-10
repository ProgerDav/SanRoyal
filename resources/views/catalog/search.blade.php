@extends('layouts.main')

@section('title')
		Поиск |
@endsection
	<!-- Shop -->
@section('content')

  @include('layouts.banner', ["text" => "Поиск"])

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

          @include('layouts.sidebar')
					
				</div>
					<!-- Shop Content -->
        <div class="col-lg-9">
					<div class="shop_content">
						<div class="shop_bar clearfix">
              <div class="shop_product_count col-lg-8 ">
                <div class="header_search_form_container search_form_container">
										<form action="{{route('catalog.search')}}" class="header_search_form clearfix">
											<input type="search" required="required" name='q' value='{{request()->q ?? ''}}' class="header_search_input"
												placeholder="Поиск продуктов..." />
											<button type="submit" class="header_search_button trans_300"><img
												src="{{asset('images/search.png')}}" alt=""></button>
										</form>
									</div>
              </div>
							<div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <a href="{{route("catalog.index")}}">Каталог</a> | 
								@if(!empty($keywords))
									По запросу &quot;{{request()->q}}&quot; ничего не найдено <div></div>
									Показаны результаты содержащие {!!implode(', ', $keywords) !!} | <span>{{$products->count()}}</span> найдено на {{request()->input('page') ?? '1'}} странице / всего найдено <span>{{$products->total()}}</span>
								@else
									@if(!empty($products))	
										По запросу &quot;{{request()->q}}&quot; <span>{{$products->count()}}</span> найдено на {{request()->input('page') ?? '1'}} странице / всего найдено <span>{{$products->total()}}</span>
									@endif	
								@endif	
							</div>
						</div>

						<div class="product_grid d-flex align-items-center flex-wrap">
							<div class="product_grid_border"></div>

              @forelse ($products as $product)
                <div class="product_item brand-item">
                  <div class="product_border"></div>
                  <div class="product_image d-flex flex-column align-items-center justify-content-center"><img
                    src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></div>
                  <div class="product_content">
                    <div class="product_price"></div>
                    <div class="product_name">
											<a href="{{route('catalog.product', ["category_slug" => Str::slug($product->sub_categories->categories->slug), "subcategory_slug" => Str::slug($product->sub_categories->slug), 'product_slug' => Str::slug($product->id.' '.$product->slug)])}}" tabindex="0">{{$product->name}}</a>
                    </div>
                  </div>
                </div>
              @empty
                <p>Ничего не найдено</p>
              @endforelse
						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row justify-content-center">
							{{--<div class="page_prev d-flex flex-column align-items-center justify-content-center"><i
									 class="fas fa-chevron-left"></i></div> --}}
							<ul class="page_nav d-flex flex-row">
                {{$products->appends(request()->input())->links()}}
							</ul>
							{{-- <div class="page_next d-flex flex-column align-items-center justify-content-center"><i 
									 class="fas fa-chevron-right"></i></div> --}}
						</div>
				</div>
			</div>
		</div>
	</div>

@endsection