@extends('admin.layouts.main')

@section('title')
    Новая категория
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.subcategories.store')}}">
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? ""}}" />
        </div>
        <div class="form-group">
          <label>Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-group">
          <label>Категория</label>
          <select class="form-control" name="category">
            @forelse ($categories as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
            @empty

            @endforelse  
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
      </form>
    </div>
@endsection