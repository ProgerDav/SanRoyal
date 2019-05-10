@extends('admin.layouts.main')

@section('title')
    Запрос прайс-листа
@endsection

@section('content')
    <div class="col-lg-5 offset-lg-1">
      <div class="form-group">
        <label>Контактное лицо</label>
        <p class="form-control">{{$request->contact_name}}</p>
      </div>
      <div class="form-group">
        <label>E-mail</label>
        <p class="form-control">{{$request->email}}</p>
      </div>
      <div class="form-group">
        <label>Контактный телефон</label>
        <p class="form-control">{{$request->phone}}</p>
      </div>
      <div class="form-group">
        <label>Название организации</label>
        <p class="form-control">{{$request->organization}}</p>
      </div>
      <div class="form-group">
        <label>Сфера деятельности</label>
        <p class="form-control">{{$request->speciality ?? '--'}}</p>
      </div>
      <div class="form-group">
        <label>Город</label>
        <p class="form-control">{{$request->city ?? '--'}}</p>
      </div>
      <div class="form-group">
        <label>Откуда вы о нас узнали</label>
        <p class="form-control">{{$request->source ?? '--'}}</p>
      </div>
      <div class="form-group">
        <label>Сайт</label>
        <p class="form-control">{{$request->site ?? '--'}}</p>
      </div>
      <div class="form-group">
        <label>Интересующий раздел(ы)</label>
        <p class="form-control">{{str_replace("-", ", ", $request->categories)}}</p>
      </div>
      <div class="form-group">
        <label>Дата отправки</label>
        <p class="form-control">{{date("d/m/y", strtotime($request->created_at))}}</p>
      </div>
    </div>
@endsection