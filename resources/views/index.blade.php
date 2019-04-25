@extends('layouts.main')

@section('content')

{{-- Banner --}}
    
    @include('layouts.banner', ["text" => ""])
    
{{-- Characteristics --}}
    <div class="characteristics">
			<div class="container">
				<div class="row">

					{{-- <!-- Char. Item --> --}}
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_1.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Партнеры</div>
								<div class="char_subtitle">50</div>
							</div>
						</div>
					</div>

					{{-- <!-- Char. Item --> --}}
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_2.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Бренды</div>
								<div class="char_subtitle">50</div>
							</div>
						</div>
					</div>

					{{-- <!-- Char. Item --> --}}
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_3.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Товары</div>
								<div class="char_subtitle">50</div>
							</div>
						</div>
					</div>

					{{-- <!-- Char. Item --> --}}
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_4.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Новинки</div>
								<div class="char_subtitle">50</div>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>
    
    {{-- New Products --}}

    <div class="deals_featured">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

						<!-- Deals -->

						<div class="deals">
							<div class="deals_title">Новинки (Рекомендуем)</div>
							<div class="deals_slider_container">

								<!-- Deals Slider -->
								<div class="owl-carousel owl-theme deals_slider">
                  @forelse ($featured as $product)
                      <div class="owl-item deals_item">
												<div class="deals_image"><img src="{{asset("images/$product->image")}}" alt="{{$product->name}}"></div>
                        <div class="deals_content">
                          <div class="deals_info_line d-flex flex-row justify-content-start">
														{{-- <div class="deals_item_category"><a href="{{route('catalog.product', ["product_slug" => Str::slug($product->slug), "subcategory_slug" => Str::slug($product->first()->sub_categories->slug)])}}"> {{$product->first()->sub_categories->name}} </a></div> --}}
														<div class="deals_item_category">{{$product->sub_categories->name}}</div>
                          </div>
                          <div class="deals_info_line d-flex flex-column justify-content-start">
                            <div class="deals_item_name">{{ $product->name }}</div>
                            {{-- <div class="deals_item_brand">{{ $product->brands() }}</div> --}}
                          </div>
                          <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                            <div class="deals_timer_content">
                              <p>
                                {{ $product->description }}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                  @empty
                      <p>
                        Ничего не найдено
                      </p>
                  @endforelse
								</div>

							</div>

							<div class="deals_slider_nav_container">
								<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
								<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
							</div>
						</div>

						<!-- Featured -->
						<div class="featured">
							<div class="tabbed_container">
								<div class="tabs">
									<ul class="clearfix">
										<li class="active">Новинки</li>
									</ul>
									<div class="tabs_line"><span></span></div>
								</div>

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="featured_slider slider">
                    @forelse ($products as $prod)
                        <div class="featured_slider_item">
                          <div class="border_active"></div>
                          <div
                            class="product_item d-flex flex-column align-items-center justify-content-center text-center">
														<a 	href="{{route('catalog.product', ['category_slug' => Str::slug($prod->sub_categories->categories->slug), 'subcategory_slug' => Str::slug($prod->sub_categories->slug), 'product_slug' => Str::slug($prod->slug)])}}"
															class="product_image d-flex flex-column align-items-center justify-content-center">
															<img src="{{asset("images/$prod->image")}}" alt="{{$prod->name}}">
														</a>
                            <div class="product_content">
                              <div class="product_category">{{$prod->sub_categories->name}}</div>
                              <div class="product_name">
                                {{$prod->name}}
                              </div>
                              <div class="product_extras">
                                <button class="product_cart_button"><a class="text-white" href="{{route('catalog.product', ['category_slug' => Str::slug($prod->sub_categories->categories->slug), 'subcategory_slug' => Str::slug($prod->sub_categories->slug), 'product_slug' => Str::slug($prod->slug)])}}" >Просмотр</a></button>
                              </div>
                            </div>
                            <ul class="product_marks">
                              {{-- <li class="product_mark product_new">Новинка!</li> --}}
                            </ul>
                          </div>
                        </div>
                    @empty
                        <p>Ничего не найдено</p>
                    @endforelse
									</div>
									<div class="featured_slider_dots_cover"></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
    </div>
    
    <div class="banner_2">
			<div class="banner_2_background" style="background-image:url(images/banner_2_background.jpg)"></div>
			<div class="banner_2_container">
				<div class="row d-flex align-items-center">
					<div class="offset-lg-1 offset-md-1 offset-sm-2 offset-xs-1 col-lg-4 col-md-4 col-sm-8 col-xs-10">
						<img src="images/image.jpg" class="banner_2_logo" alt="SanRoyal" />
					</div>
					<div class="offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1 col-lg-6 col-md-6 col-sm-10 col-xs-10">
						<article class="about_banner_text">
							<h2 class="about_banner_title">О Нас</h2>
							Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo asperiores rem id rerum obcaecati veritatis
							inventore placeat suscipit saepe, ipsam nisi quos qui possimus vero exercitationem fugit? Quasi,
							repellendus
							omnis?
							Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo asperiores rem id rerum obcaecati veritatis
							inventore placeat suscipit saepe, ipsam nisi quos qui possimus vero exercitationem fugit? Quasi,
							repellendus
							omnis?
							Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo asperiores rem id rerum obcaecati veritatis
							inventore placeat suscipit saepe, ipsam nisi quos qui possimus vero exercitationem fugit? Quasi,
							repellendus
							omnis?
							Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo asperiores rem id rerum obcaecati veritatis
							inventore placeat suscipit saepe, ipsam nisi quos qui possimus vero exercitationem fugit? Quasi,
							repellendus
							omnis?
						</article>
						<a href="#" class="button">Читать дальше</a>
					</div>
        </div>
        

    <div class="new_arrivals">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="tabbed_container">
							<div class="tabs clearfix tabs-right">
								<div class="new_arrivals_title">Акции</div>
								<ul class="clearfix">
									<li class="active">Акции</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>
							<div class="row">
								<div class="col-lg-9" style="z-index:1;">

									<!-- Product Panel -->
									<div class="product_panel panel active">
										<div class="arrivals_slider slider">

                      @forelse ($sales as $product)
                          <!-- Slider Item -->
                        <div class="arrivals_slider_item">
                          <div class="border_active"></div>
                          <div
                            class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
															<img src="{{asset("images/$product->image")}}" alt="{{$product->name}}">
														</div>
                              <div class="product_content">
                                <div class="product_category">{{$product->sub_categories->name}}</div>
                                <div class="product_name">
                                  <div><a href="product.html">{{$product->name}}</a></div>
                                </div>
                                <div class="product_extras">
                                  <button class="product_cart_button">Просмотр</button>
                                </div>
                              </div>
                              <ul class="product_marks">
                                {{-- <li class="product_mark product_discount">-25%</li> --}}
                              </ul>
                            </div>
                          </div>
                      @empty
                          <p>Ничего не найдено</p>
                      @endforelse
                    </div>
                </div>
              </div>
              <div class="col-lg-3">
									<div class="arrivals_single clearfix">
										<div class="d-flex flex-column align-items-center justify-content-center">
											<div class="arrivals_single_image"><img src="images/new_single.png" alt=""></div>
											<div class="arrivals_single_content">
												<div class="arrivals_single_category"><a href="#">Категория</a></div>
												<div class="arrivals_single_name_container clearfix">
													<div class="arrivals_single_name"><a href="#">LUNA Smartphone</a></div>
													<div class="arrivals_single_price text-right"></div>
												</div>
												<div>
													Lorem ipsum dolor sit amet.
												</div>
												<button class="arrivals_single_button">Просмотр</button>
											</div>
											<ul class="arrivals_single_marks product_marks">
												<li class="arrivals_single_mark product_mark product_new">new</li>
											</ul>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
    </div>
    
    <div class="best_sellers">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="tabbed_container">
							<div class="tabs clearfix tabs-right">
								<div class="new_arrivals_title">Категории</div>
								<ul class="clearfix">
									<li class="active">Категории</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>

							<div class="bestsellers_panel panel active">

								<!-- Best Sellers Slider -->

								<div class="bestsellers_slider slider">
                  @forelse ($categories as $category)
                    <div class="bestsellers_item">
                      <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                        <div class="bestsellers_image"><img src="{{asset("images/$category->image")}}" alt="{{$category->name}}"></div>
                        <div class="bestsellers_content">
                          {{-- <div class="bestsellers_category"><a href="#"></a></div> --}}
                          <div class="bestsellers_name"><a href="{{route('catalog.category', ['category_slug' => Str::slug($category->slug)])}}">{{$category->name}}</a></div>
                          <div class="bestsellers_price"></div>
                        </div>
                      </div>
                      <ul class="bestsellers_marks">
                      </ul>
                    </div>
                  @empty
                      <p>Ничего не найдено</p>
                  @endforelse
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection