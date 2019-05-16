@extends('layouts.main')

@section('title')
    О нас |
@endsection

@section('content')
    
  <div class="shop">
		<div class="container">
			<div class="row">
        <div class="col-lg-3">
          @include('layouts.sidebar')
        </div>

        <div class="col-lg-9">
          {{-- Content --}}
          <div class="shop_content">
            <div class="shop_bar clearfix">
              <div class="shop_product_count"><a href="{{route('index')}}">Главная</a> > <span>О нас</span></div>
            </div>
            <div class="product_grid d-flex align-items-center flex-wrap">
            <div class="product_grid_border"></div> 
              <div class="row single_item">
                <article class="col-lg-9 single_item_text">
                  <h2 class="single_item_title">Sanroyal</h2>
                  <p>
                    Компания ООО <strong>«Санрояль»</strong> более XX лет работает на российском рынке инженерной
                    сантехники. На протяжении всего этого времени мы стремимся выстраивать
                    долгосрочные взаимовыгодные отношения с клиентами и партнерами. Для достижения
                    этой цели наша команда проводит клиентоориентированную политику, которая
                    позволяет нам постоянно быть в курсе потребительского спроса и своевременно отвечать
                    на вызовы рынка.
                  </p>
                  <p>
                    На сегодняшний день ассортимент продукции в наших каталогах насчитывает более X тысяч наименований, в том числе:
                    <ul>
                      <li>оборудование для систем тепло- и водоснабжения,</li>
                      <li>запорная, регулирующая и водосливная арматура,</li>
                      <li>насосное оборудование,</li>
                      <li>водонагревательные приборы,</li>
                      <li>осмесители,</li>
                      <li>инструменты и комплектующие.</li>
                    </ul>
                  </p>
                  <p>
                    О высоком уровне доверия к нашей компании говорят прямые контракты с ведущими
                    производителями России, Европы и Азии. Вся поставляемая продукция консолидируется
                    на собственном складе в Москве, откуда заказы отправляются по всему столичному
                    региону и в другие точки России.
                  </p>
                  <p>
                    За время своего существования наша компания стала надежным связующим звеном
                    между производителями и конечными потребителями. Предоставляя полный
                    ассортимент инженерной сантехники, мы стремимся постоянно повышать качество
                    обслуживания и предлагать широкую линейку продукции по самым выгодным ценам.
                  </p>
                  <p>
                    Чтобы получить подробную информацию о продукции и узнать условия оплаты и доставки заказов, свяжитесь с нашим отделом продаж по телефону XXXXXXXXX.
                  </p>
                </article>  
                <div class="col-lg-12">
                  <img src="{{asset("images/blog_1.jpg")}}" alt="Sanroyal" class="single_item_img_responsive" />
                </div>
              </div>       
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection