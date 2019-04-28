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
          <label>Описание</label>
          <textarea name="description" id="product-description" >{{old('description') ?? ''}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
      </form>
    </div>
    @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'product-description' );
        </script>
    @endpush
@endsection