					<div class="shop_sidebar_toggle bg-primary text-white"><i class="fa fa-bars"></i><i class="fa fa-times"></i></div>					
					<div class="shop_sidebar_overlay"></div>
					<span id="indicator"></span>
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Каталог</div>
							<ul class="sidebar_categories">
								@if ($catalogs->count() > 0)
									<li>
										<a href="{{route('catalog.download.index')}}">
											<img class="sidebar_image" src="{{asset("images/download.png")}}" />
											Скачать каталоги
										</a>
										<button class="sidebar_toggle"><i class="fa fa-chevron-down"></i></button>
										<ul class="sidebar_subs">
											@forelse ($catalogs as $catalog)
												<li>
													<a href="{{asset("documents/catalogs/$catalog->file")}}"><img class="sidebar_image" src="{{asset("images/$catalog->image")}}" />{{$catalog->title}}</a>
												</li>
											@empty
													
											@endforelse	
										</ul>
									</li>
								@endif
								@forelse ($categories as $category)
									<li>
										<a href="{{route('catalog.category', ['category_slug' => Str::slug($category->id.' '.$category->slug)])}}">
											<img class="sidebar_image" src="{{asset("images/$category->image")}}" />
											{{$category->name}}
										</a>
										<button class="sidebar_toggle"><i class="fa fa-chevron-down"></i></button>
										<ul class="sidebar_subs">
											@forelse ($category->subcategories as $subcategory)
												<li>
													<a href="{{route('catalog.subcategory', ['category_slug' => Str::slug($category->slug), 'subcategory_slug' => Str::slug($subcategory->id.' '.$subcategory->slug)])}}"><img class="sidebar_image" src="{{asset("images/$subcategory->image")}}" />{{$subcategory->name}}</a>
												</li>
											@empty
													
											@endforelse	
										</ul>
									</li>
								@empty
									<p>Ничего не найдено</p>
								@endforelse
							</ul>
						</div>
						@if (isset($filter))
							<div class="sidebar_section filter_by_section">
								<div class="sidebar_title">Сортировать по</div>
							</div>
							<div class="sidebar_section">
								<div class="sidebar_subtitle brands_subtitle">Бренду</div>
								<ul class="brands_list">
									<form id="sortByBrands" action="?" method="GET" >
										@if (count($available_brands) > 1)
											@foreach ($available_brands as $brand)
													<li class="brand">
														<label class="custom_checkbox_label">
															@if (request()->brands)
																<input type="checkbox" name="brands[]" value='{{Str::slug($brand->slug)}}' {{in_array(Str::slug($brand->slug), request()->brands) ? 'checked' : ''}}>
															@else
																<input type="checkbox" name="brands[]" value='{{Str::slug($brand->slug)}}'>
															@endif
															<span class="custom_checkbox"><i class="fa fa-check"></i></span>
															<span class="brand_filter">{{$brand->name}}</span>
														</label>
													</li>													
											@endforeach
											<button class="btn btn-primary">Применить</button>
											<a href="{{url()->current()}}" class="btn btn-default">Сбросить</a>
										@else
											<p>Пусто</p>
										@endif
									</form>
									{{-- <script>
										document.getElementById('sortByBrands').addEventListener('submit', function(e){
											if (window.history) {
												e.preventDefault();
												let 
													url = "{{request()->url()}}",
													data = new FormData(e.target),
													params = new URLSearchParams();

												for(let item of data.entries()){
													params.append(item[0], item[1]);
												}
												
												window.history.pushState({}, null, url + '?' + params);
											}
										})
									</script>	 --}}
								</ul>
							</div>
						@endif
					</div>