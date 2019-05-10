@extends('admin.layouts.main')

@section('title')
    Категории
@endsection

@section('buttons')
  <a href="{{route('admin.categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
@endsection

@section('content')
    <div class="col-lg-11 offset-lg-1">
      @if (session()->get('success'))
        <div class="alert alert-success">
        {{session()->get('success')}}
        </div>
      @endif
      <table class="table table-hover table-bordered text-center">
        <thead class="text-left">
          <tr>
            <th>Название</th>
            <th>Изображение</th>
            <th>Редактировать | Смотреть</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <td>{{$category->name}}</td>
              <td><img class="img-sm" src="{{asset("images/$category->image")}}" alt="{{$category->name}}" /></td>
              <td>
                <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <a href="{{route('catalog.category', ['category_slug' => Str::slug($category->id.' '.$category->slug)])}}" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
              </td>
              <td>
                <button class="btn btn-danger del" data-toggle='modal' data-id="{{$category->id}}" data-target="#trashModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          @empty
            <h3>Данные отсутствуют</h3>
          @endforelse
        </tbody>
      </table>
      @if (isset($category))
        <div class="modal fade" id="trashModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><span class="text-danger">Внимание!</span></div>
              <div class="modal-body">
                При удалении этой категории все подкатегории и продукты будут удалены.
              </div>
              <div class="modal-footer">
                <form method="POST" id="forceDelete" action="{{route('admin.categories.destroy', ["category" => $category->id + 1])}}">     
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
          <script>
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