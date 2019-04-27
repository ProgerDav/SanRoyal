@extends('admin.layouts.main')

@section('title')
    Редактируемая категория - {{$subcategory->name}}
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.subcategories.update', $subcategory->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? $subcategory->name}}" />
        </div>
        <div class="form-group">
          <label>Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-group">
          <label>Категория</label>
          <select class="form-control" name="category">
            @forelse ($categories as $cat)
              @if (old('category'))
                <option {{$cat->id == old('category') ? 'selected' : ''}} value="{{$cat->id}}">{{$cat->name}}</option>
              @else
                <option {{$cat->id === $subcategory->categories->id ? 'selected' : ''}} value="{{$cat->id}}">{{$cat->name}}</option>                  
              @endif  
            @empty

            @endforelse  
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
@endsection