@extends('admin.layouts.main')

@section('title')
    Новый Пост
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.posts.store')}}">
        @csrf
        <div class="form-group">
          <label>Заголовок</label>
          <input class="form-control" type="text" name="title" value="{{old('title') ?? ""}}" />
        </div>
        <div class="form-group">
          <label>Изображение</label>
          <input class="form-control" type="file" allow="image/*" name="image" />
        </div>
        <div class="form-group">
          <label>Доп. Изображения (до 3)</label>
          <input class="form-control" type="file" name="additional_images[]" multiple />          
        </div>
        <div class="form-group">
          <label>Содержание</label>
          <textarea name="body" id="post-body" >{{old('body') ?? ''}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
      </form>
    </div>
    @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'post-body' );
        </script>
    @endpush
@endsection