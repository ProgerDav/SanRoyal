@extends('admin.layouts.main')

@section('title')
    Редактируемая Вакансия - {{$vacancy->name}}
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
      <form method="post" action="{{route('admin.vacancies.update', ['vacancy' => $vacancy->id])}}">
        @method('PATCH')        
        @csrf
        <div class="form-group">
          <label>Название</label>
          <input class="form-control" type="text" name="name" value="{{old('name') ?? $vacancy->name}}" />
        </div>
        <div class="form-group">
          <label>Зарплата</label>
          <input class="form-control" type="text" name="salary" value="{{old('salary') ?? $vacancy->salary}}" />
        </div>
        <div class="form-group">
          <label>Описание</label>
          <textarea name="description" id="vacancy-description">{{old('description') ?? $vacancy->description}}</textarea>
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