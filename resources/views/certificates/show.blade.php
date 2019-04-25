@extends('layouts.main')

@section('title')
    {{$certificate->title}}
@endsection

@section('content')
  
  @include('layouts.banner', ["text" => $certificate->title])

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
            <div class="shop_product_count">
             <a href="{{route("index")}}">Главная</a> > <a href='{{route('certificates.index')}}'>Сертификаты</a> > <span>{{$certificate->title}}</span></div>
						</div>

						<div class="product_grid d-flex align-items-center flex-wrap">
              <div class="product_grid_border"></div>
              <div class='col-lg-11 offset-lg-1 text-center'>
                <img src="{{asset("images/$certificate->image")}}" alt="{{$certificate->title}}" class="col-lg-6 ">
              </div>
						</div>
				</div>
			</div>
		</div>
	</div>

@endsection