@extends('admin.layouts.main')

@section('title')
    Редактируемый Бренд - {{$brand->name}}
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.brands.update', $brand->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? $brand->name}}" />
        </div>
        <div class="form-group">
          <label>Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-group">
          <label>Описание</label>
          <textarea name="description" id="brand-description" >{{old('description') ?? $brand->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
     @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'brand-description' );
        </script>
    @endpush
@endsection