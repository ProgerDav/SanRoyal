<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{asset('css/styles/bootstrap4/bootstrap.min.css')}}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/styles/admin.css')}}">  
  <link href="//fonts.googleapis.com/css?family=Lato:400,900,400italic,700italic" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Административная панель</title>
</head>
<body class='skin-blue'>
  <div class="wrapper">

      <header class="main-header">
          <a href="{{route('admin.index')}}" class="logo">Административная панель</a>
          <nav class="navbar navbar-static-top" role="navigation"></nav>
      </header>
      <aside class="main-sidebar">
          <section class="sidebar">
              <ul class="sidebar-menu">
                <li class="{{request()->is('admin-panel') ? 'active' : ''}}"><a href="{{route('admin.index')}}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                <li class="header">Каталог</li>
                <li class="{{request()->is('admin-panel/catalogs') ? 'active' : ''}}"><a href="{{route('admin.catalogs.index')}}"><i class="fa fa-download"></i>Каталог</a></li>
                <li class="{{request()->is('admin-panel/categories') ? 'active' : ''}}"><a href="{{route('admin.categories.index')}}"><i class="fa fa-server"></i>Категории</a></li>
                <li class="{{request()->is('admin-panel/subcategories') ? 'active' : ''}}"><a href="{{route('admin.subcategories.index')}}"><i class="fa fa-folder"></i>Подкатегории</a></li>
                <li class="{{request()->is('admin-panel/products') ? 'active' : ''}}"><a href="{{route('admin.products.index')}}"><i class="fa fa-product-hunt"></i>Продукты</a></li>
                <li class="{{request()->is('admin-panel/brands') ? 'active' : ''}}"><a href="{{route('admin.brands.index')}}"><i class="fa fa-tags"></i>Бренды</a></li>
                <li class="{{request()->is('admin-panel/certificates') ? 'active' : ''}}"><a href="{{route('admin.certificates.index')}}"><i class="fa fa-certificate"></i>Сертифткаты</a></li>
                <li class="header">О нас</li>
                <li class="{{request()->is('admin-panel/posts') ? 'active' : ''}}"><a href="{{route('admin.posts.index')}}"><i class="fa fa-file"></i>Новости</a></li>
                <li class="{{request()->is('admin-panel/vacancies') ? 'active' : ''}}"><a href="{{route('admin.vacancies.index')}}"><i class="fa fa-user"></i>Вакансии</a></li>
                <li class="header">Запросы / Сообщения</li>
                <li class="{{request()->is('admin-panel/requests') ? 'active' : ''}}"><a href="{{route('admin.requests.index')}}"><i class="fa fa-calculator"></i>Прайс-лист</a></li>
                <li class="{{request()->is('admin-panel/messages') ? 'active' : ''}}"><a href="{{route('admin.messages.index')}}"><i class="fa fa-envelope"></i>Обратная Связь</a></li>
                <li class="header"></li>
                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Выход</a></li>
              </ul>
          </section>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <div class="row">
            <div class="col-md-8">
              <h3 style="margin-top: 5px"><i class="fa fa-folder"></i> @yield('title')</h3>
            </div>
            <div class="col-md-4">
              @yield('buttons')
            </div>
          </div>
        </section>
        <div class="col-md-12">
          <div id="alertTarget"></div>
        </div>
        <section class="content">
          @yield('content')
        </section>
      </div>
      <footer class="main-footer">
        <strong>Powered by <a href="https://web-ex.tech">WebexTech</a>.</strong>
      </footer>
  </div>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  @stack('scripts')
</body>
</html>