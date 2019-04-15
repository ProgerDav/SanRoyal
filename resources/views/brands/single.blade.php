@extends('layouts.main')

@section('title')
    {{$brand->first()->name ?? "Не Найдено"}}
@endsection

@section('content')
    
  <div class="shop">
		<div class="container">
			<div class="row">
        <div class="col-lg-3">
          @include('layouts.sidebar')
        </div>

        <div class="col-lg-9">
          {{-- Content --}}
          <div class="shop_content">
            <div class="shop_bar clearfix">
              <div class="shop_product_count"></div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
            <div class="product_grid_border"></div>
            @if($brand->count() == 0)
              <h3>Ничего на найдено</h3>
            @else  
              <div class="row single_item">
                <article class="col-lg-9 single_item_text">
                  <h2 class="single_item_title">{{$brand->first()->name}}</h2>
                  <p>
                    {!! $brand->first()->description !!}
                    {{var_dump($arr)}}
                    @foreach ($brand->first()->products as $item)
                        {{-- <br />{{var_dump($item->sub_categories)}} --}}
                    @endforeach
                  </p>
                </article>  
                <div class="col-lg-3">
                  <img src="{{asset("images/".$brand->first()->image)}}" alt="{{$brand->first()->name}}" class="single_item_img_responsive" />
                </div>
              </div>       
            </div>
            @endif
        </div>
      </div>
    </div>
  </div>
@endsection