@extends('layouts.main')
	<!-- Shop -->
@section('content')

  @include('layouts.banner', ["text" => $subcategory->name])

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

          @include('layouts.sidebar', ['filter' => true])
					
				</div>
					<!-- Shop Content -->
        <div class="col-lg-9">
					<div class="shop_content">
						<div class="shop_bar clearfix">
            <div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <a href="{{route("catalog.index")}}">Каталог</a> > <a href="{{route("catalog.category", ["category_slug" => Str::slug($category->slug)])}}">{{$category->name}}</a> > <span>{{$subcategory->name}}</span> | <span>{{$products->count()}}</span> найдено на {{request()->input('page') ?? '1'}} странице / всего найдено <span>{{$products->total()}}</span></div>
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

              @forelse ($products as $product)
                <div class="product_item brand-item">
                  <div class="product_border"></div>
                  <div class="product_image d-flex flex-column align-items-center justify-content-center"><img
                    src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></div>
                  <div class="product_content">
                    <div class="product_price"></div>
                    <div class="product_name">
                      <a href="#" tabindex="0">{{$product->name}}</a>
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
								{{-- <li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">...</a></li>
                <li><a href="#">21</a></li> --}}
                {{$products->links()}}
							</ul>
							{{-- <div class="page_next d-flex flex-column align-items-center justify-content-center"><i 
									 class="fas fa-chevron-right"></i></div> --}}
						</div>
				</div>
			</div>
		</div>
	</div>

@endsection
	

	{{-- <script src="js/jquery-3.3.1.min.js"></script> 
	<script src="styles/bootstrap4/popper.js"></script>
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="plugins/greensock/TweenMax.min.js"></script>
	<script src="plugins/greensock/TimelineMax.min.js"></script>
	<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="plugins/greensock/animation.gsap.min.js"></script>
	<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
	<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
	<script src="plugins/parallax-js-master/parallax.min.js"></script>
	<script src="js/shop_custom.js"></script> --}}