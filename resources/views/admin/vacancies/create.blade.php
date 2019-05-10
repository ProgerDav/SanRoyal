@extends('admin.layouts.main')

@section('title')
    Новая Вакансия
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
      <form method="post" action="{{route('admin.vacancies.store')}}">
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? ""}}" />
        </div>
        <div class="form-group">
          <label>Зарплата</label>
          <input class="form-control" type="text" value="{{old('salary' ?? "")}}" name="salary" />
        </div>
        <div class="form-group">
          <label>Описание</label>
          <textarea name="description" id="vacancy-description">{{old('description') ?? ""}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
      </form>
    </div>
    @push('scripts')
        <script src="{{asset("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>
        <script>
            CKEDITOR.replace( 'vacancy-description' );
        </script>
    @endpush
@endsection