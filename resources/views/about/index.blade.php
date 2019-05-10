@extends('layouts.main')

@section('title')
    О нас |
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
              <div class="shop_product_count"><a href="{{route('index')}}">Главная</a> > <span>О нас</span></div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
            <div class="product_grid_border"></div> 
              <div class="row single_item">
                <article class="col-lg-9 single_item_text">
                  <h2 class="single_item_title">Sanroyal</h2>
                  <p>
                   Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum quidem assumenda iure minus, quibusdam blanditiis, dicta, laboriosam et exercitationem accusantium quod suscipit. Assumenda aliquid consequuntur commodi quibusdam excepturi praesentium fuga?
                  </p>
                  <p>
                   Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum quidem assumenda iure minus, quibusdam blanditiis, dicta, laboriosam et exercitationem accusantium quod suscipit. Assumenda aliquid consequuntur commodi quibusdam excepturi praesentium fuga?
                  </p>
                </article>  
                <div class="col-lg-12">
                  <img src="{{asset("images/blog_1.jpg")}}" alt="Sanroyal" class="single_item_img_responsive" />
                </div>
              </div>       
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection