@extends('admin.layouts.main')

@section('title')
    Новый Продукт
@endsection

@section('content')
    <div class="col-lg-7 offset-lg-1">
      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <span style="display:block" class="text-danger">{{ $error }}</span>
            @endforeach
        </div>
      @endif
      @if (session()->get('success'))
        <div class="alert alert-success">
          {{session()->get('success')}}
        </div>
      @endif
      <form method="post" enctype="multipart/form-data" action="{{route('admin.products.store')}}">
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? ""}}" />
        </div>
        <div class="form-group">
          <label>Главное Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-group">
          <label>Доп. Изображения (2)</label>
          <input class="form-control" type="file" allow="image/*" multiple name="additional_images[]" />
        </div>
        <div class="form-group">
          <label>Подкатегория</label>
          <select class="form-control" name="subcategory">
            @forelse ($subcategories as $cat)
              <option {{old('subcategory') == $cat->id ? 'selected' : ''}} value="{{$cat->id}}">{{$cat->name}}</option>
            @empty

            @endforelse  
          </select>
        </div>
        <div class="form-group">
          <label>Бренд</label>
          <select class="form-control" name="brand">
            @forelse ($brands as $brand)
              <option {{old('brand') == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
            @empty

            @endforelse  
          </select>
        </div>
        <div class="form-group">
          <label>Производство</label>
          <input type="text" class="form-control" name='production' value="{{old('production') ?? ''}}" />
        </div>
        <div class="form-group">
          <label>Гарантия</label>
          <input type="text" class="form-control" name='warranty' value="{{old('warranty') ?? ''}}" />
        </div>
        <div class="form-group">
          <label>Описание</label>
          <textarea name="description" id="product-description" >{{old('description') ?? ''}}</textarea>
        </div>
        <h4>Доп. характеристики</h4>
        <div class="chars">
          
        </div>
        <button type="button" class="add-inp btn btn-md btn-primary"><i class="fa fa-plus"></i></button>
        <hr>
        <button type="submit" class="btn btn-primary">Создать</button>
      </form>
    </div>
    @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'product-description' );

            $('.add-inp').click(function(){
              let num = $('.char').length ? $('.char').length : 0;
              $('.chars').append('<div class="char row" id='+ ++num +'><div class="form-group col-lg-5"><label>Название характеристики</label><input type="text" name="properties[]" class="form-control" /></div><div class="form-group col-lg-5"><label>Зачение характеристики</label><input type="text" name="values[]" class="form-control" /></div><div class="form-group text-center col-lg-2"><label class="col-lg-12">Удалить</label><button type="button" data-id='+ num +' class="btn btn-md btn-danger del-char"><i class="fa fa-trash"></i></button></div></div>');
            });

            $(document).on('click', '.del-char', function(){
              const id = $(this).data('id');
              $(`#${id}`).remove();
            });
        </script>
    @endpush
@endsection