@extends('admin.layouts.main')

@section('title')
    Продукты
@endsection

@section('buttons')
  <a href="{{route('admin.products.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
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
            <th>Производство</th>
            <th>Гарантия</th>
            <th>Подкатегория</th>
            <th>Бренд</th>
            <th>Редактировать | Смотреть</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>{{$product->name}}</td>
              <td><img class="img-sm" src="{{asset("images/$product->image")}}" alt="{{$product->name}}" /></td>
              <td>{{$product->production}}</td>
              <td>{{$product->warranty}}</td>
              <td>{{$product->sub_categories->name}}</td>
              <td>{{$product->brands->name}}</td>
              <td>
                <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <a href="{{route('catalog.product', ['category_slug' => Str::slug($product->sub_categories->categories->slug), 'subcategory_slug' => Str::slug($product->sub_categories->slug), 'product_slug' => Str::slug($product->id.' '.$product->slug)])}}" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
              </td>
              <td>
                <button class="btn btn-danger del" data-toggle='modal' data-id="{{$product->id}}" data-target="#trashModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          @empty
            <h3>Данные отсутствуют</h3>
          @endforelse
        </tbody>
      </table>
      @if (isset($product))    
        <div class="modal fade" id="trashModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><span class="text-danger">Внимание!</span></div>
              <div class="modal-body">
                При удалении данные будут потеряны.
              </div>
              <div class="modal-footer">
                <form method="POST" id="forceDelete" action="{{route('admin.products.destroy', ["products" => $product->id + 1])}}">  
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