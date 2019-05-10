@extends('layouts.main')

@section('title')
    Сертификаты |
@endsection

@section('content')

  @include('layouts.banner', ["text" => "Сертификаты"])

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
            <div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <span>Сертификаты</span> | <span>{{$certificates->count()}}</span> найдено </div>
						</div>

						<div class="product_grid d-flex align-items-center flex-wrap">
							<div class="product_grid_border"></div>

              @forelse ($certificates as $certificate)
                <div class="product_item brand-item">
                  <div class="product_border"></div>
                  <a href="{{route('certificates.show', ["slug" => Str::slug($certificate->id." ".$certificate->title)])}}" class="product_image d-flex flex-column align-items-center justify-content-center"><img
                    src="{{asset("images/$certificate->image")}}" alt="{{$certificate->title}}"></a>
                  <div class="product_content">
                    <div class="product_price"></div>
                    <div class="product_name">
											<a href="{{route('certificates.show', ["slug" => Str::slug($certificate->id." ".$certificate->title)])}}">{{$certificate->title}}</a>
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
