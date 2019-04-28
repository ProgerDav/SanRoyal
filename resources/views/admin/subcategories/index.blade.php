@extends('admin.layouts.main')

@section('title')
    Подкатегории
@endsection

@section('buttons')
  <a href="{{route('admin.subcategories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
@endsection

@section('content')
    <div class="col-lg-11 offset-lg-1">
      @if (session()->get('success'))
        <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
      @endif
      <table id="data" class="table table-hover table-bordered text-center">
        <thead class="text-left">
          <tr>
            <th>Название</th>
            <th>Изображение</th>
            <th>Категория</th>
            <th>Редактировать | Смотреть</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($subcategories as $subcategory)
            <tr>
              <td>{{$subcategory->name}}</td>
              <td><img class="img-sm" src="{{asset("images/$subcategory->image")}}" alt="{{$subcategory->name}}" /></td>
              <td>{{$subcategory->categories->name}}</td>
              <td>
                <a href="{{route('admin.subcategories.edit', ['subcategory' => $subcategory->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <a href="{{route('catalog.subcategory', ['category_slug' => Str::slug($subcategory->categories->slug), 'subcategory_slug' => Str::slug($subcategory->id.' '.$subcategory->slug)])}}" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
              </td>
              <td>
                <button class="btn btn-danger del" data-toggle='modal' data-id="{{$subcategory->id}}" data-target="#trashModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          @empty
            <h3>Данные отсутствуют</h3>
          @endforelse
        </tbody>
      </table>
      @if(isset($subcategory))
        <div class="modal fade" id="trashModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><span class="text-danger">Внимание!</span></div>
              <div class="modal-body">
                При удалении этой подкатегории все её продукты будут удалены.
              </div>
              <div class="modal-footer">
                <form method="POST" id="forceDelete" action="{{route('admin.subcategories.destroy', ["category" => $subcategory->id + 1])}}">  
                  @csrf
                  @method('DELETE')
                  <input type="hidden" name="id" />
                  <button class="btn btn-danger"><i class="fa fa-trash"></i> Удалить все</button>
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
              }
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