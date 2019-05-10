@extends('admin.layouts.main')

@section('title')
    Категории
@endsection

@section('buttons')
  <a href="{{route('admin.catalogs.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
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
            <th>Каталог</th>
            <th>Редактировать | Смотреть</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($catalogs as $catalog)
            <tr>
              <td>{{$catalog->title}}</td>
              <td><img class="img-sm" src="{{asset("images/$catalog->image")}}" alt="{{$catalog->title}}" /></td>
              <td><a href="{{asset("/documents/catalogs/$catalog->file")}}">Скачать</a></td>
              <td>
                <a href="{{route('admin.catalogs.edit', ['catalog' => $catalog->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                {{-- <a href="{{route('catalog.category', ['category_slug' => Str::slug($category->id.' '.$category->slug)])}}" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a> --}}
              </td>
              <td>
                <button class="btn btn-danger del" data-toggle='modal' data-id="{{$catalog->id}}" data-target="#trashModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          @empty
            <h3>Данные отсутствуют</h3>
          @endforelse
        </tbody>
      </table>
      @if (isset($catalog))
        <div class="modal fade" id="trashModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><span class="text-danger">Внимание!</span></div>
              <div class="modal-body">
                При удалении данные будут потеряны.
              </div>
              <div class="modal-footer">
                <form method="POST" id="forceDelete" action="{{route('admin.catalogs.destroy', ["catalog" => $catalog->id + 1])}}">     
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