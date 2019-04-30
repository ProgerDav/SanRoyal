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
  <title>SanRoyal - @yield('title')</title>
</head>
<body>
  
  <!-- Header -->

		<header class="header">

			<!-- Top Bar -->

			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col d-flex flex-row">
							<!-- <div class="top_bar_contact_item"> 
								 <div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+38 068 005 3570 
							 </div> -->
							<div class="top_bar_contact_item">
								<div class="top_bar_icon"><img src="{{asset('images/mail.png')}}" alt=""></div><a
									href="mailto:fastsales@gmail.com">sanroyal@gmail.com</a>
							</div>
							<div class="top_bar_content ml-auto">
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">
										<!-- <li>
											<a href="#">English<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="#">Italian</a></li>
												<li><a href="#">Spanish</a></li>
												<li><a href="#">Japanese</a></li>
											</ul>
										</li> -->
										<li>
											<a href="#">
												<div class="top_bar_icon"><img src="{{asset('images/phone.png')}}" alt=""></div>
												+7 916-124-19-57
											</a>
											<ul>
												<li><a href="#">+7 919-104-45-94 - Viber</a></li>
												<li><a href="#">+38 068 005 3570 - Whats Up</a></li>
												<li><a href="#">+38 068 005 3570 - Messenger</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Header Main -->

			<div class="header_main">
				<div class="container">
					<div class="row">

						<!-- Logo -->
						<div class="col-lg-3 col-md-4 col-sm-3 col-3 order-1">
							<div class="logo_container">
								<div class="logo"><a href="{{route('index')}}"><img src="{{asset('images/logo.png')}}" alt="SanRoyal"></a></div>
							</div>
						</div>

						<!-- Search -->
						<div class="offset-lg-3 offset-md-2 col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
							<div class="header_search">
								<div class="header_search_content">
									<div class="header_search_form_container">
										<form action="{{route('catalog.search')}}" class="header_search_form clearfix">
											<input type="search" required="required" name='q' value='{{request()->q ?? ''}}' class="header_search_input"
												placeholder="Поиск продуктов..." />
											<button type="submit" class="header_search_button trans_300" value="Submit"><img
												src="{{asset('images/search.png')}}" alt=""></button>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Wishlist -->
						<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						</div>
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<nav class="main_nav">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="main_nav_content d-flex flex-row">

								<!-- Categories Menu -->

								<div class="cat_menu_container">
									<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
										<div class="cat_burger"><span></span><span></span><span></span></div>
										<div class="cat_menu_text">Каталог товаров</div>
									</div>

									<ul class="cat_menu">
										@foreach ($categories as $cat)
												<li>
													<a href="{{route('catalog.category', ['category_slug' => Str::slug($cat->id.' '.$cat->slug)])}}">
														<img class="cat_menu_image" src="{{ asset("images/".$cat->image) }}" alt={{$cat->name}}>
														{{$cat->name}}
													</a>
													<span class="cat_menu_toggle"><i class="fa fa-chevron-right"></i></span>
													<ul>
														@foreach ($cat->subcategories as $sub_cat)
															<li>
																<a href="{{route('catalog.subcategory', ['category' => Str::slug($cat->slug), 'subcategory' => Str::slug($sub_cat->id.' '.$sub_cat->slug)])}}">
																	<img class="cat_menu_image" src="{{ asset("images/".$sub_cat->image) }}" alt="{{$sub_cat->name}}">
																	{{$sub_cat->name}}
																</a>
															</li>
														@endforeach
													</ul>
												</li>
										@endforeach
									</ul>
								</div>

								<!-- Main Nav Menu -->

								<div class="main_nav_menu ml-auto">
									<ul class="standard_dropdown main_nav_dropdown">
										<li><a href="{{route('catalog.index')}}">Каталог<i class="fas fa-chevron-down"></i></a></li>
										<li><a href="#">Прайс-лист</a></li>
										<li><a href="{{route("brands.index")}}">Бренды</a></li>
										<li>
											<a href="{{route("certificates.index")}}">Сертификаты</a>
										</li>
										<li class="hassubs">
											<a href="{{route('about.index')}}">О компании<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="{{route('about.blog')}}">Новости</a></li>
												<li><a href="#">Вакансии</a></li>
											</ul>
										</li>
										<li><a href="{{route('contact')}}">Контакты</a></li>
									</ul>
								</div>

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
			</nav>

			<!-- Menu -->

			<div class="page_menu">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="page_menu_content">

								<div class="page_menu_search">
									<form action="#">
										<input type="search" required="required" class="page_menu_search_input"
											placeholder="Поиск продуктов...">
									</form>
								</div>
								<ul class="page_menu_nav">
									<li class="page_menu_item">
										<a href="{{route("catalog.index")}}">Каталог</a>
									</li>
									<li class="page_menu_item has-children">
										<a href="#">Прайс-лист</a>
									</li>
									<li class="page_menu_item has-children">
										<a href="{{route('brands.index')}}">Бренды</a>
										<!-- <ul class="page_menu_selection">
									<li><a href="#">Бренды<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
								</ul> -->
									</li>
									<li class="page_menu_item"><a href="{{route('certificates.index')}}">Сертификаты</a></li>
									<li class="page_menu_item"><a href="about.php">О компании</a></li>

									<li class="page_menu_item"><a href="{{route('contact')}}">Контакты</a></li>
								</ul>

								<div class="menu_contact">
									<div class="menu_contact_item">
										<div class="menu_contact_icon"><img src="{{asset('images/phone_white.png')}}" alt=""></div>+38 068 005 3570
									</div>
									<div class="menu_contact_item">
										<div class="menu_contact_icon"><img src="{{asset('images/mail_white.png')}}" alt=""></div><a
											href="mailto:fastsales@gmail.com">sanroyal@gmail.com</a>
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

								<!-- Recently Viewed Slider -->

								<div class="owl-carousel owl-theme viewed_slider">

									@if (isset($_COOKIE['viewed_products']) AND !empty($_COOKIE['viewed_products']))
											@foreach (json_decode($_COOKIE['viewed_products']) as $viewed_product)
													<div class="owl-item">
														<div
															class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
															<div class="viewed_image"><img src="{{asset("images/$viewed_product->image")}}" alt="{{$viewed_product->name}}"></div>
															<div class="viewed_content text-center">
																{{-- <div class="viewed_price">Lorem</div>  --}}
																<div class="viewed_name"><a href="">{{$viewed_product->name}}</a></div>
															</div>
															<ul class="item_marks">
																<li class="item_mark item_new">new</li>
															</ul>
														</div>
													</div>													
											@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Brands -->

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

			<!-- Newsletter -->

			<div class="newsletter">
				<div class="container">
					<div class="row">
						<div class="col">
							<div
								class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
								<div class="newsletter_title_container">
									<div class="newsletter_icon"><img src="{{asset('images/send.png')}}" alt=""></div>
									<div class="newsletter_title">Лента новостей</div>
									<div class="newsletter_text">
										<p>...lorem ispum dolor sit amet.</p>
									</div>
								</div>
								<div class="newsletter_content clearfix">
									<form action="#" class="newsletter_form">
										<input type="email" class="newsletter_input" required="required" placeholder="Email...">
										<button class="newsletter_button">Подписаться</button>
									</form>
									<div class="newsletter_unsubscribe_link"><a href="#">Отписаться</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer -->

			<footer class="footer">
				<div class="container">
					<div class="row">

						<div class="col-lg-3 footer_col">
							<div class="footer_column footer_contact">
								<div class="logo_container">
									<div class="logo"><a href="#">SanRoyal</a></div>
								</div>
								<div class="footer_title"> Звоните нам 24/7</div>
								<div class="footer_phone">+7 919-104-45-94</div>
								<div class="footer_phone">+7 916-124-19-57</div>
								<div class="footer_contact_text">
									<p>Адрессная линия 1</p>
									<p>Адрессная линия 2</p>
								</div>
								<div class="footer_social">
									<ul>
										<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="#"><i class="fab fa-twitter"></i></a></li>
										<li><a href="#"><i class="fab fa-youtube"></i></a></li>
										<li><a href="#"><i class="fab fa-google"></i></a></li>
										<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-lg-2 offset-lg-2">
							<div class="footer_column">
								<div class="footer_title">Быстрый Поиск</div>
								<ul class="footer_list">
									<li><a href="#">Computers & Laptops</a></li>
									<li><a href="#">Cameras & Photos</a></li>
									<li><a href="#">Hardware</a></li>
									<li><a href="#">Smartphones & Tablets</a></li>
									<li><a href="#">TV & Audio</a></li>
								</ul>
								<div class="footer_subtitle">Gadgets</div>
								<ul class="footer_list">
									<li><a href="#">Car Electronics</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="footer_column">
								<ul class="footer_list footer_list_2">
									<li><a href="#">Video Games & Consoles</a></li>
									<li><a href="#">Accessories</a></li>
									<li><a href="#">Cameras & Photos</a></li>
									<li><a href="#">Hardware</a></li>
									<li><a href="#">Computers & Laptops</a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="footer_column">
								<div class="footer_title">Customer Care</div>
								<ul class="footer_list">
									<li><a href="#">My Account</a></li>
									<li><a href="#">Order Tracking</a></li>
									<li><a href="#">Wish List</a></li>
									<li><a href="#">Customer Services</a></li>
									<li><a href="#">Returns / Exchange</a></li>
									<li><a href="#">FAQs</a></li>
									<li><a href="#">Product Support</a></li>
								</ul>
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