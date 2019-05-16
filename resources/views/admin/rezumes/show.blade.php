@extends('admin.layouts.main')

@section('title')
    Отправленные резюме
@endsection

@section('content')
    <div class="col-lg-5 offset-lg-1">
      <div class="form-group">
        <label>Имя</label>
        <p class="form-control">{{$rezume->name}}</p>
      </div>
      <div class="form-group">
        <label>E-mail</label>
        <p class="form-control">{{$rezume->email}}</p>
      </div>
      <div class="form-group">
        <label>Контактный телефон</label>
        <p class="form-control">{{$rezume->phone}}</p>
      </div>
      <div class="form-group">
        <label>Должность</label>
        <p class="form-control">{{$rezume->profession}}</p>
      </div>
      <div class="form-group">
        <label>Файл</label>
        <p class="form-control"><a href="{{asset("/documents/rezumes/$rezume->file")}}">{{$rezume->file}}</a></p>
      </div>
      <div class="form-group">
        <label>Текст</label>
        <p class="form-control">{{$rezume->text}}</p>
      </div>
      <div class="form-group">
        <label>Дата отправки</label>
        <p class="form-control">{{date("d/m/y", strtotime($rezume->created_at))}}</p>
      </div>
    </div>
@endsection