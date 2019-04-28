@extends('admin.layouts.main')

@section('title')
    Редактируемый Пост - {{$post->title}}
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
      <form method="post" enctype="multipart/form-data" action="{{route('admin.posts.update', $post->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label>Заголовок</label>
          <input class="form-control" type="text" name="title" value="{{old('title') ?? $post->title}}" />
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
          <textarea name="body" id="post-body" >{{old('body') ?? $post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
      </form>
    </div>
     @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'post-body' );
        </script>
    @endpush
@endsection