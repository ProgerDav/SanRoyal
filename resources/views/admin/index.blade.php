@extends('admin.layouts.main')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-server fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$cat_num}}</div>
                <div>Категорий</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.categories.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-warning text-white">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-folder fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$subcat_num}}</div>
                <div>Подкатегорий</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.subcategories.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-info text-white">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-product-hunt fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$product_num}}</div>
                <div>Продуктов</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.categories.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-tags fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$brand_num}}</div>
                <div>Брендов</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.brands.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-light text-black">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-certificate fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$certificate_num}}</div>
                <div>Сертификатов</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.certificates.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-4">
        <div class="card">
          <div class="card-header bg-success text-white">
            <div class="row">
              <div class="col-lg-3">
                <i class="fa fa-file fa-5x"></i>
              </div>
              <div class="col-lg-9 text-right display-5 font-weight-bold">
                <div class="huge">{{$post_num}}</div>
                <div>Новостей</div>
              </div>
            </div>
          </div>
          <a href="{{route('admin.posts.index')}}">
            <div class="card-body">
              <span class="pull-left">Подробнее</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
@endsection