@extends('layouts.main')

@section('title')
    Обратная связь
@endsection

@section('content')
  <div class="contact_info">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="images/contact_1.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Phone</div>
								<div class="contact_info_text">+7 919-104-45-94</div>
								<div class="contact_info_text">+7 916-124-19-57</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Email</div>
								<div class="contact_info_text">fastsales@gmail.com</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="images/contact_3.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Address</div>
								<div class="contact_info_text">10 Suffolk at Soho, London, UK</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact Form -->

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">Оставьте сообщение</div>

            <form method="post" action="{{route('contact')}}" id="contact_form">
              @method('POST')
              @csrf
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" name="name" class="contact_form_name input_field" placeholder="Имя" required="required">
								<input type="text" name="email" class="contact_form_email input_field" placeholder="Email адресс" required="required">
								<input type="text" name="phone" class="contact_form_phone input_field" placeholder="Номер телефона">
							</div>
							<div class="contact_form_text">
								<textarea name="message" class="text_field contact_form_message" name="message" rows="4" placeholder="Сообщение" required="required"></textarea>
							</div>
							<div class="contact_form_button">
								<button type="submit" class="button contact_submit_button">Отправить</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

	<!-- Map -->

	<div class="contact_map">
		<div id="google_map" class="google_map">
			<div class="map_container">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d69413.19010232904!2d37.55182864539572!3d55.73654933328565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54bb88c866ab3%3A0xbc939fab80b34024!2sKiyevsky+railway+station!5e0!3m2!1sen!2s!4v1556472372015!5m2!1sen!2s" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
@endsection