          <div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Каталог</div>
							<ul class="sidebar_categories">
								@forelse ($categories as $category)
									<li>
										<a href="#">
											<img class="sidebar_image" src="{{asset("images/$category->image")}}" />
											{{$category->name}}
										</a>
										<button class="sidebar_toggle"><i class="fa fa-chevron-down"></i></button>
										<ul class="sidebar_subs">
											@forelse ($category->subcategories as $subcategory)
												<li>
													<a href="#"><img class="sidebar_image" src="{{asset("images/$subcategory->image")}}" />{{$subcategory->name}}</a>
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
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
									<li class="brand">
										<label class="custom_checkbox_label">
											<input type="checkbox">
											<span class="custom_checkbox"><i class="fa fa-check"></i></span>
											<span class="brand_filter">Apple</span>
										</label>
									</li>
								</ul>
							</div>
						@endif
					</div>