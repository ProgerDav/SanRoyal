@extends('admin.layouts.main')

@section('title')
    Заросы прайс-листа
@endsection

@section('buttons')
  {{-- <a href="{{route('admin.products.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a> --}}
@endsection

@section('content')
    <div class="col-lg-12">
      @if (session()->get('success'))
        <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <span style="display:block" class="text-danger">{{ $error }}</span>
            @endforeach
        </div>
      @endif
      <table id="data" class="table table-hover table-bordered text-center">
        <thead class="text-left">
          <tr>
            <th>Контактное лицо</th>
            <th>E-mail</th>
            <th>Контактный телефон</th>
            <th>Название организации</th>
            <th>Сфера деятельности</th>
            <th>Город</th>
            <th>Интересующий раздел(ы)</th>
            <th>Дата отправки</th>
            <th>Смотреть | Удалить</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($requests as $request)
            <tr>
              <td>{{$request->contact_name}}</td>
              <td>{{$request->email}}</td>
              <td>{{$request->phone}}</td>
              <td>{{$request->organization}}</td>
              <td>{{$request->speciality}}</td>
              <td>{{$request->city}}</td>
              <td>{{str_replace("-", ", ", $request->categories)}}</td>
              <td>{{date("d/m/y", strtotime($request->created_at))}}</td>
              <td>
                <a class="btn btn-success" href="{{route('admin.requests.show', ['request' => $request->id])}}" ><i class="fa fa-eye"></i></a>
                <button class="btn btn-danger del" data-toggle='modal' data-id="{{$request->id}}" data-target="#trashModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          @empty
            <h3>Данные отсутствуют</h3>
          @endforelse
        </tbody>
      </table>
      @if (isset($request))    
        <div class="modal fade" id="trashModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><span class="text-danger">Внимание!</span></div>
              <div class="modal-body">
                При удалении данные будут потеряны.
              </div>
              <div class="modal-footer">
                <form method="POST" id="forceDelete" action="{{route('admin.requests.destroy', ["request" => $request->id + 1])}}">  
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="id" />
                  <button class="btn btn-danger"><i class="fa fa-trash"></i> Удалить</button>
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
              </div>
            </div>
          </div>
        </div>
      @push('scripts')
          <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
          <script>
            $("#data").DataTable({
              "language": {
                "info": "Показаны результаты с _START_ по _END_. Всего: _TOTAL_",
                "emptyTable": "Ничего не найдено.",
                "search": "Поиск: ",
                "lengthMenu": "Показывать _MENU_ строк(и)",
                "paginate": {
                    "next":       "Следующая",
                    "previous":   "Предыдущая"
                },
              },
              'columnDefs': [ {
                'targets': [0,1,2,3,4], 
                'orderable': false,
              }]
            });
            $(document).on('click', '.del', function(){
              const 
                id = $(this).data('id'),
                action = $("#forceDelete").attr('action').split('/');
                action[action.length - 1] = id;
              $("#forceDelete").attr('action', action.join('/'));
            });
          </script>    
      @endpush
    @endif
    </div>
@endsection