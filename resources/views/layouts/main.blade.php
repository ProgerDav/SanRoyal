<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="{{asset('css/styles/bootstrap4/bootstrap.min.css')}}">
	<link href="{{asset('js/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{asset('js/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('js/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('js/plugins/OwlCarousel2-2.2.1/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('js/plugins/slick-1.8.0/slick.css')}}">
	@stack('styles')
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
  <title> @yield('title') SanRoyal</title>
</head>
<body>
  <!-- Header -->

		<header class="header">

			<!-- Top Bar -->

			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col d-flex flex-row">
							<div class="top_bar_contact_item">
								<div class="top_bar_icon"><img src="{{asset('images/mail.png')}}" alt=""></div><a
									href="mailto:info@san-royal.ru">info@san-royal.ru</a>
							</div>
							<div class="top_bar_contact_item d-none d-lg-block d-md-block ml-4">
								<ul>
									<li class="hassubs">
											<div class="top_bar_icon"><img src="{{asset('images/phone.png')}}" alt=""></div>
											<a href="tel:+79161241957">+7 (499) 499 60 90</a> |
											<a href="tel:+79191044594">+7 (919) 104 45 94</a>	
									</li>
								</ul>
							</div>
							<div class="top_bar_contact_item ml-auto">
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">
										<li class="hassubs">
											<a target="_blank" href="https://www.facebook.com/%D0%A1%D0%B0%D0%BD%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0-%D0%A1%D0%B0%D0%BD%D0%A0%D0%BE%D1%8F%D0%BB%D1%8C-2332031817036383/"class="social-icon"><i class="fab fa-3x fa-facebook-square"></i></a>
										</li>
										<li class="hassubs">
											<a target="_blank" href="https://viber.com/chat?number=79268058766"class="social-icon"> 
												<i class="fab fa-2x fa-viber"></i>
											</a>
										</li>
										<li class="hassubs">
											{{-- <a target="_blank" href="https://api.whatsapp.com/send?phone=7926805-87-66" class="social-icon">  --}}
											<a target="_blank" href="https://wa.me/79268058766" class="social-icon"> 
												<i class="fab fa-2x fa-whatsapp"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="top_bar_contact_item ml_auto">
								<ul>
									<li>
										{{-- <a href="#" id="searchbar_toggle" class="top_bar_icon  pl-2 pr-2 ml-4"><img src="{{asset('/images/search.png')}}" class="mr-1" alt="" />Поиск</a> --}}
										<a href="#" id="searchbar_toggle" class="top_bar_icon  pl-2 pr-2 ml-4"><i class="fa fa-search"></i> Поиск</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Header Main -->

			<div class="header_main">
				<div id="searchbar">
					<div class="header_search container">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{route('catalog.search')}}" class="header_search_form clearfix">
										<input type="search" required="required" name='q' value='{{request()->q ?? ''}}' class="header_search_input" placeholder="Поиск продуктов..." />
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('images/search.png')}}" alt=""></button>
										<button type="button" class="header_search_button searchbar_close btn-default trans_300" value="Submit"><i class="fa fa-times fa-2x"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<div class="searchbar_overlay"></div>
				<div class="container">
					<div class="row">

						<!-- Logo -->
						<div class="col-lg-3 col-md-4 col-sm-3 col-3">
							<div class="logo_container">
								<div class="logo"><a href="{{route('index')}}"><img src="{{asset('images/logo.jpg')}}" alt="SanRoyal"></a></div>
							</div>
						</div>

						<nav class="main_nav col-lg-9 col-md-8 col-sm-9 row align-items-center justify-content-center">
							<div class="col">
								<div class="main_nav_content d-flex flex-row">
									<ul class="d-flex  standart_dropdown main_nav_dropdown">
										<li>
											<a href="{{route('catalog.index')}}">Каталог</a>
											<ul class="dropdown_big container d-flex flex-wrap">
												@if ($catalogs->count() > 0)
													<li class="col-lg-4 d-flex">
														<div class="col-lg-3">
															<img class="cat_menu_image" src="{{asset("images/download.png")}}" alt="Скачать каталоги">
														</div>
														<div class="col-lg-9">
															<a href="{{route('catalog.download.index')}}">
																Скачать каталоги
															</a>
															<ul>
																@foreach($catalogs as $catalog)
																	<li>
																		<a href="{{asset("/documents/catalogs/$catalog->file")}}" title="{{$catalog->name}}">{{$catalog->name}}</a>
																	</li>																			
																@endforeach
															</ul>
														</div>
													</li>	
												@endif
												@forelse ($categories as $cat)
													<li class="col-lg-4 d-flex">
														<div class="col-lg-3">
															<img class="cat_menu_image" src="{{asset("images/$cat->image")}}" alt="{{$cat->name}}">
														</div>
														<div class="col-lg-9">
															<a href="{{route('catalog.category', ['category_slug' => Str::slug($cat->id.' '.$cat->slug)])}}" title="{{$cat->name}}">
																{{$cat->name}}
															</a>
															<ul>
																@forelse ($cat->subcategories as $subcat)
																	<li>
																		<a href="{{route('catalog.subcategory', ['category_slug' => Str::slug($cat->slug), 'subcategory_slug' => Str::slug($subcat->id.' '.$subcat->slug)])}}">{{$subcat->name}}</a>
																	</li>	
																@empty
																		
																@endforelse
															</ul>
														</div>
													</li>
												@empty
														
												@endforelse
											</ul>
										</li>
										<li><a href="{{route('price-list')}}">Прайс-лист</a></li>
										<li><a href="{{route("brands.index")}}">Бренды</a></li>
										<li class="hassubs">
											<a href="{{route('about.index')}}">О компании</a>
											<ul>
												<li><a href="{{route('about.blog')}}">Новости</a></li>
												<li><a href="{{route('about.vacancies')}}">Вакансии</a></li>
											</ul>
										</li>
										<li>
											<a href="{{route("certificates.index")}}">Сертификаты</a>											
										</li>
										<li><a href="{{route('contact')}}">Контакты</a></li>
										<li class="more" style="display: none">
											<a href="{{route('contact')}}">...</a>
											<ul>
												{{-- <li><a href="{{route('about.blog')}}">Новости</a></li> --}}
												{{-- <li><a href="{{route('about.vacancies')}}">Вакансии</a></li> --}}
											</ul>
										</li>
									</ul>
									<div class="menu_trigger_container ml-auto">											
										<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
											<div class="menu_burger">
												<div class="menu_trigger_text">menu</div>
												<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</nav>
						
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			{{-- <nav class="main_nav">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col">

							<div class="main_nav_content d-flex flex-row">

								

								<!-- Menu Trigger -->

								<div class="menu_trigger_container ml-auto">
									<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
										<div class="menu_burger">
											<div class="menu_trigger_text">menu</div>
											<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</nav> --}}

			<!-- Menu -->

			<div class="page_menu">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="page_menu_content">

								<div class="page_menu_search">
									<form action="{{route('catalog.search')}}">
										<input type="search" name="q" required value="{{request()->q ?? '' }}" class="page_menu_search_input"
											placeholder="Поиск продуктов...">
									</form>
								</div>
								<ul class="page_menu_nav">
									<li class="page_menu_item">
										<a href="{{route("catalog.index")}}">Каталог</a>
									</li>
									<li class="page_menu_item">
										<a href="{{route('price-list')}}">Прайс-лист</a>
									</li>
									<li class="page_menu_item">
										<a href="{{route('brands.index')}}">Бренды</a>
									</li>
									<li class="page_menu_item"><a href="{{route('certificates.index')}}">Сертификаты</a></li>
									<li class="page_menu_item has-children">
										<a href="{{route('about.index')}}">О компании</a>
										<ul class="page_menu_selection">
											<li><a href="{{route('about.blog')}}">Новости</a></li>
											<li><a href="{{route('about.vacancies')}}">Вакансии</a></li>
										</ul> 
									</li>

									<li class="page_menu_item"><a href="{{route('contact')}}">Контакты</a></li>
								</ul>

								<div class="menu_contact">
									<div class="menu_contact_item">
										<div class="menu_contact_icon"><img src="{{asset('images/phone_white.png')}}" alt=""></div><a href="tel:+7 916-124-19-57">+7 916-124-19-57</a> 
									</div>
									<div class="menu_contact_item">
										<div class="menu_contact_icon"><img src="{{asset('images/mail_white.png')}}" alt=""></div><a
											href="mailto:info@san-royal.ru">info@san-royal.ru</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

    </header>
    

    <div class="super_container">
		
			@yield('content')
			
    	<!-- Recently Viewed -->

			<div class="viewed">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="viewed_title_container">
								<h3 class="viewed_title">Ранее вы смотрели</h3>
								<div class="viewed_nav_container">
									<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
									<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
								</div>
							</div>

							<div class="viewed_slider_container">
								<div class="owl-carousel owl-theme viewed_slider">
									@if (!empty($viewed))
											@foreach ($viewed as $viewed_product)
													<div class="owl-item">
														<div
															class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
															<div class="viewed_image"><img src="{{asset("images/$viewed_product->image")}}" alt="{{$viewed_product->name}}" /></div>
															<div class="viewed_content text-center">
																<div class="viewed_name"><a href="{{route('catalog.product', ['category_slug' => Str::slug($viewed_product->sub_categories->categories->slug), 'subcategory_slug' => Str::slug($viewed_product->sub_categories->slug), 'product_slug' => Str::slug($viewed_product->id.' '.$viewed_product->slug)])}}">{{$viewed_product->name}}</a></div>
															</div>
														</div>
													</div>
													@php
															$i = $loop->index;
													@endphp													
											@endforeach
											@for ($j = 0; $j < 8 - $i; $i++)
													<div class="owl-item jumbotron"></div>			
											@endfor
									@else
										<div class="owl-item jumbotron"></div>		
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="brands">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="brands_slider_container">

								<!-- Brands Slider -->

								<div class="owl-carousel owl-theme brands_slider">

									@forelse ($brands as $brand)
										<div class="owl-item">
											<div class="brands_item d-flex flex-column justify-content-center">		
												<img src="{{asset("images/$brand->image")}}" alt="{{$brand->name}}">
											</div>
										</div>
									@empty
											<p>Ничего не найдено</p>
									@endforelse
								</div>
								<!-- Brands Slider Navigation -->
								<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
								<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>

{{-- 
			<div class="newsletter">
				<div class="container">
					<div class="row">
						<div class="col">
							<div
								class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
								<div class="newsletter_title_container">
									<div class="newsletter_icon"><img src="{{asset('images/send.png')}}" alt=""></div>
									<div class="newsletter_title">Lorem Ipsum</div>
									<div class="newsletter_text">
										<p>...lorem ispum dolor sit amet.</p>
									</div>
								</div>
								<div class="newsletter_content clearfix">
									<form action="#" class="newsletter_form">
										<input type="email" class="newsletter_input" required="required" placeholder="Email...">
										<button class="newsletter_button">Отправить</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> --}}

			<!-- Footer -->

			<footer class="footer">
				<div class="container">
					<div class="row">

						<div class="col-lg-3 footer_col">
							<div class="footer_column footer_contact">
								<div class="logo_container">
									<div class="logo"><a href="{{route('index')}}">SanRoyal</a></div>
								</div>
								<div class="footer_title">Звоните нам 24/7</div>
								<div class="footer_phone"><a href="mailto:info@san-royal.ru">info@san-royal.ru</a></div>
								<div class="footer_phone">+7 919-104-45-94</div>
								<div class="footer_phone">+7 916-124-19-57</div>
								<div class="footer_contact_text">
									<p>Адрессная линия 1</p>
									<p>Адрессная линия 2</p>
								</div>
							</div>
						</div>

						<div class="col-lg-2 offset-lg-2">
							<div class="footer_column">
								<div class="footer_title">Быстрый Поиск</div>
								<ul class="footer_list">
									@forelse ($categories as $cat)
										<li><a href="{{route('catalog.category', ['category_slug' => Str::slug($cat->id.' '.$cat->slug)])}}">{{$cat->name}}</a></li>											
									@empty
											
									@endforelse
								</ul>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="footer_column">
								<div class="footer_title">О компании</div>
								<ul class="footer_list">
									<li><a href="{{route('about.index')}}">О нас</a></li>
									<li><a href="{{route('about.blog')}}">Новости</a></li>
									<li><a href="{{route('about.vacancies')}}">Вакансии</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="footer_column">
								<div class="footer_title">Оставайтесь на связи</div>
								<div class="footer_social">
									<ul>
										<li><a target="_blank" href="https://www.facebook.com/%D0%A1%D0%B0%D0%BD%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D0%B0-%D0%A1%D0%B0%D0%BD%D0%A0%D0%BE%D1%8F%D0%BB%D1%8C-2332031817036383/"><i class="fab fa-facebook-f fa-2x"></i></a></li>
										<li><a target="_blank" href="#"><i class="fab fa-viber fa-2x"></i></a></li>
										<li><a target="_blank" href="#"><i class="fab fa-whatsapp fa-2x"></i></a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</footer>

			<!-- Copyright -->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
								<div class="copyright_content">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
									Copyright &copy;
									<script>document.write(new Date().getFullYear());</script> All rights reserved
									<!--| This template is made
								with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
									target="_blank">Colorlib</a> -->
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</div>
								<!-- <div class="logos ml-sm-auto">
								<ul class="logos_list">
									<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
									<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
									<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
									<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
								</ul>
							</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
</div>

  
	<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('js/plugins/greensock/TweenMax.min.js')}}"></script>
	<script src="{{asset('js/plugins/greensock/TimelineMax.min.js')}}"></script>
	<script src="{{asset('js/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
	<script src="{{asset('js/plugins/greensock/animation.gsap.min.js')}}"></script>
	<script src="{{asset('js/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
	<script src="{{asset('js/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
	<script src="{{asset('js/plugins/slick-1.8.0/slick.js')}}"></script> 
	<script src="{{asset('js/plugins/easing/easing.js')}}"></script>
	@stack('scripts')
	<script src="{{asset('js/custom.js')}}"></script>

</body>
</html>