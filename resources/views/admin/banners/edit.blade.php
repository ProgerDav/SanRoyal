@extends('admin.layouts.main')

@section('title')
    Редактируемый Баннер - {{$banner->subcategory->name}}
@endsection

@section('content')
    <div class="col-lg-5 offset-lg-1">
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.banners.update', $banner->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label>Подкатегория</label>
          <select class="form-control" name="subcategory">
            @forelse ($subcategories as $cat)
              <option {{old('subcategory') == $cat->id ? 'selected' : $banner->subcategory->id == $cat->id ? 'selected' : ''}} value="{{$cat->id}}">{{$cat->name}}</option>
            @empty

            @endforelse  
          </select>
        </div>
        <div class="form-group">
          <label>Бренд</label>
          <select class="form-control" name="brand">
            @forelse ($brands as $brand)
              <option {{old('brand') == $brand->id ? 'selected' : $banner->brand->id == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
            @empty

            @endforelse  
          </select>
        </div>
        <div class="form-group">
          <label>Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-control mb-4 d-flex align-items-center">
          <input id="main" type="checkbox" value="1" name="main" {{old('main') ? "checked" : $banner->main ? 'checked' : ''}} class="mr-2">
          <label class="custom-control-label mt-1" for="main">Главный</label>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection