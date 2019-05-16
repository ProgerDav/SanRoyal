@extends('layouts.main')

@section('title')
    Вакансии |
@endsection

@section('content')

  @include('layouts.banner', ["text" => 'Вакансии'])
    
  <div class="shop">
		<div class="container">
			<div class="row">
        <div class="col-lg-3">
          @include('layouts.sidebar')
        </div>

        <div class="col-lg-9">
          <div class="modal fade" id="contactModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">Отправить резюме</div>
                <div class="modal-body">
                  <div class="alert alert-success" style="display: none"><span class="text-success"></span></div>
                  <form method="POST" id="vacancyForm" enctype="multipart/form-data" action="{{route('about.vacancies.request')}}">  
                    @csrf
                    <label class="col-12">
                      Ваше имя*
                      <input type="text" class="form-control" id="name" name="name">
                      <span class="text-danger mt-1"></span>
                    </label>
                    <label class="col-12">
                      Телефон*
                      <input type="telephone" class="form-control" name="phone">
                      <span class="text-danger mt-1"></span>
                    </label>
                    <label class="col-12">
                      E-mail*
                      <input type="email" class="form-control" name="email">
                      <span class="text-danger mt-1"></span>
                    </label>
                    <label class="col-12">
                      Желаемая должность*
                      <input type="text" class="form-control" id="prof" name="profession" />
                      <span class="text-danger mt-1"></span>
                    </label>
                    <label class="col-12">
                      Прикрепить файл*
                      <input type="file" class="form-control" name="file" />
                      <span class="text-danger mt-1"></span>
                    </label>
                    <label class="col-12">
                      Текст резюме*
                      <textarea class="form-control" name="text"></textarea> 
                      <span class="text-danger mt-1"></span>
                    </label>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                  <button form="vacancyForm" class="btn btn-info"><i class="fa fa-paper-plane"></i> Отправить</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="shop_content">
            <div class="shop_bar clearfix">
              <div class="shop_product_count"><a href="{{route('index')}}">Главная</a> > <a href="{{route('about.index')}}">О нас</a> > <span>Вакансии</span> </div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
            <div class="product_grid_border"></div> 
              <div class="panel-group container-fluid">
                @forelse ($vacancies as $vacancy)
                    <div class="panel panel-default jumbotron pt-3 pb-2">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" href="{{"#panel-body$vacancy->id"}}"><span class="vacancy-name">{{$vacancy->name}}</span> <span class="float-right">{{$vacancy->salary}}<span></a>
                        </h4>
                      </div>
                      <div id="{{"panel-body$vacancy->id"}}" class="panel-collapse collapse">
                        <article class="panel-body">
                          {!! $vacancy->description !!}
                        </article>
                        <a href="#" data-toggle="modal" data-target="#contactModal" class="open-modal btn btn-primary">Отправить резюме</a> 
                      </div>
                    </div>
                @empty
                    
                @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script>
        $("#vacancyForm").submit(function(e){
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
              if(data.errors){
                console.log(data.errors);
                data.errors.map(function(e){
                  const parts = e.split('-');
                  $(`[name=${parts[1]}] + .text-danger`).text(parts[0]);
                });
                return false;
              }

              setTimeout(() => $("#contactModal").modal('hide'), 2000);
              $(this).find(".form-control").val('');
              $(".alert-success").show().text(data.success);
            },
            error: error => console.log(error)
          });
        });

        $(document).on('click', '.open-modal', function(){
          $(".alert-success").hide().text("");
          $(".text-danger").text("");
          const name = $(this).closest('.panel').find('.vacancy-name').text();
          $("#prof").attr('value', name); 
        });
      </script> 
  @endpush
@endsection