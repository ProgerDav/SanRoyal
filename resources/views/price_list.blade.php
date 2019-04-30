@extends('layouts.main')

@section('title')
    Прайс-лист
@endsection

@section('content')
  
  @include('layouts.banner', ["text" => "Прайс-лист"])

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
              <div class="shop_product_count"><a href="{{route("index")}}">Главная</a> > <span>Прайс-лист</span></div>
            </div>
            <div class="product_grid">
              <div class="product_grid_border"></div>
                <h2 class="text-center">Зарос Прайс-листа</h2>
                <div class="col-lg-8 offset-lg-2 mt-4">
                  <form action="{{route('price-list')}}" method="POST" >
                    <div class="form-group">
                      <label>Контактное лицо*</label>
                      <input type="text" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>E-mail*</label>
                      <input type="email" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Контактный телефон*</label>
                      <input type="telephone" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Название организации*</label>
                      <input type="text" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Сфера деятельности</label>
                      <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Город</label>
                      <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Откуда вы о нас узнали</label>
                      <input type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Ваш сайт</label>
                      <input type="url" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Выберите интересующий раздел(ы)</label>
                      <div class="form-group row">
                        @forelse ($categories as $cat)
                          <div class="row align-items-center col-lg-4">
                              <input type="checkbox" value="{{$cat->name}}" name='category[]' />
                              <label>{{$cat->name}}</label>
                          </div>
                        @empty
                          Данные отсутствуют  
                        @endforelse
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg">Отправить</button>
                  </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection