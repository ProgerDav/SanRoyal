@extends('layouts.main')

@section('title')
    Прайс-лист |
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
                @if (session()->get('success'))
                  <div class="alert alert-success">
                    {{session()->get('success')}}
                  </div>
                @endif
                <div class="col-lg-8 offset-lg-1 mt-4">
                  <form action="{{route('price-list-store')}}" method="POST" >
                    @csrf
                    <div class="form-group">
                      <label>Контактное лицо*</label>
                      <input type="text" name="contact_name" value="{{old('contact_name' ?? '')}}" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>E-mail*</label>
                      <input type="email" name="email" value="{{old('email') ?? ''}}" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Контактный телефон*</label>
                      <input type="telephone" name="phone" value="{{old('phone' ?? '')}}" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Название организации*</label>
                      <input type="text" name="organization" value="{{old('organization') ?? ''}}" required class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Сфера деятельности</label>
                      <input type="text" name="speciality" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Город</label>
                      <input type="text" name="city" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Откуда вы о нас узнали</label>
                      <input type="text" name="source" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Ваш сайт</label>
                      <input type="url" name="site" class="form-control" />
                    </div>
                    <div class="form-group">
                      <label>Выберите интересующий раздел(ы)*</label>
                      <div class="form-group row">
                        @forelse ($categories as $cat)
                            <div class="custom-control custom-checkbox mb-3 col-lg-4">
                              <input type="checkbox" class="custom-control-input" id="{{$cat->name}}" value="{{$cat->name}}"  name="categories[]" />
                            <label class="custom-control-label" for="{{$cat->name}}">{{$cat->name}}</label>
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