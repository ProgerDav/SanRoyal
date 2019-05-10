@extends('layouts.main')

@section('title')
		Скачать каталоги | 
@endsection

@section('content')

  @include('layouts.banner', ["text" => "Скачать каталоги"])

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
            <div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <a href="{{route("catalog.index")}}">Каталог</a> > <span>Скачать каталоги</span> | <span>{{$catalogs->count()}}</span> найдено </div>
						</div>

						<div class="product_grid d-flex align-items-center flex-wrap">
							<div class="product_grid_border"></div>

              @forelse ($catalogs as $catalog)
                <a href="{{asset("/documents/catalogs/$catalog->file")}}" target="_blank" class="product_item brand-item">
                  <div class="product_border"></div>
                  <div class="product_image d-flex flex-column align-items-center justify-content-center"><img
                    src="{{asset("images/$catalog->image")}}" alt="{{$catalog->title}}"></div>
                  <div class="product_content">
                    <div class="product_price"></div>
                    <div class="product_name">
											<h4>{{$catalog->title}}</h4>
                    </div>
                  </div>
                </a>
              @empty
                <p>Ничего не найдено</p>
              @endforelse
            </div>
				</div>
			</div>
		</div>
	</div>

@endsection