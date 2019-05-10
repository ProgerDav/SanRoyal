@extends('admin.layouts.main')

@section('title')
    Сообщение
@endsection

@section('content')
    <div class="col-lg-5 offset-lg-1">
      <div class="form-group">
        <label>Имя</label>
        <p class="form-control">{{$message->name}}</p>
      </div>
      <div class="form-group">
        <label>E-mail</label>
        <p class="form-control">{{$message->email}}</p>
      </div>
      <div class="form-group">
        <label>Контактный телефон</label>
        <p class="form-control">{{$message->phone ?? '--'}}</p>
      </div>
      <div class="form-group">
        <label>Текст сообщения</label>
        <p class="form-control">{{$message->message}}</p>
      </div>
      <div class="form-group">
        <label>Дата отправки</label>
        <p class="form-control">{{date("d/m/y", strtotime($message->created_at))}}</p>
      </div>
    </div>
@endsection