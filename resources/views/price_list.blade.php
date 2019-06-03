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
                {{-- @if (session()->get('success')) --}}
                  <div class="alert alert-success" style="display: none">
                    {{-- {{session()->get('success')}} --}}
                  </div>
                {{-- @endif --}}
                <div class="col-lg-8 offset-lg-1 mt-4">
                  <form action="{{route('price-list-store')}}" id="priceForm" method="POST" >
                    @csrf
                    <div class="form-group">
                      <label>Контактное лицо*</label>
                      <input type="text" name="name" value="{{old('contact_name' ?? '')}}"  class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>E-mail*</label>
                      <input type="email" name="email" value="{{old('email') ?? ''}}"  class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Контактный телефон*</label>
                      <input type="telephone" name="phone" value="{{old('phone' ?? '')}}"  class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Название организации*</label>
                      <input type="text" name="organization" value="{{old('organization') ?? ''}}"  class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Сфера деятельности</label>
                      <input type="text" name="speciality" class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Город</label>
                      <input type="text" name="city" class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Откуда вы о нас узнали</label>
                      <input type="text" name="source" class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label>Ваш сайт</label>
                      <input type="url" name="site" class="form-control" />
                      <span class="text-danger"></span>
                    </div>
                    <div class="form-group panel panel-default">
                      <div class="panel-title">
                        <label class="form-control"><a href="#" data-toggle="collapse" data-target="#checkbox_group">Выберите интересующий раздел(ы)*</a></label>
                      </div>
                      <div class="collapse ml-4 panel-collapse form-group row" id="checkbox_group">
                        @forelse ($categories as $cat)
                            <div class="custom-control custom-checkbox mb-3 col-lg-4">
                              <input type="checkbox" class="custom-control-input" id="{{$cat->id}}" value="{{$cat->name}}"  name="categories[]" />
                              <label class="custom-control-label" for="{{$cat->id}}">{{$cat->name}}</label>
                            </div>
                        @empty
                          Данные отсутствуют  
                        @endforelse
                      </div>
                      <span class="text-danger" id="categories-span"></span>
                    </div>
                    <button class="btn btn-primary btn-lg"><i class="fa fa-spinner ajax-spin" style="display: none"></i> Отправить</button>
                  </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script>
        $("#priceForm").submit(function(e){
          $('.btn-lg i').show();
          $('.btn-lg').attr('disabled', 'disabled');
          $(".text-danger").text('');
          e.preventDefault();
          const 
            url = $(this).attr('action'),
            data = new FormData(e.target);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $("[name=_token]").val()
            }
          });
          $.ajax({
            url: url,
            method: 'post',
            type: "POST",
            data: data,
            contentType: false, 
            processData: false,
            success: data => {
              $('.btn-lg i').hide();
              $('.btn-lg').removeAttr('disabled');
              if(data.errors){
                console.log($(this).offset().top);
                data.errors.map(function(e){
                  const parts = e.split('-');
                  if(parts[1] == 'categories'){ $("#categories-span").text(parts[0]); return false}
                  $(`[name=${parts[1]}] + .text-danger`).text(parts[0]);
                });
                $('html, body').animate({scrollTop: $(this).offset().top - 50}, 700)
                return false;
              }
            },
            error: error => console.log(error)
          });
        });
      </script> 
  @endpush
@endsection