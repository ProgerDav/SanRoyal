@extends('layouts.main')

@section('title')
    Обратная связь |
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
								<div class="contact_info_text"><a href="tel:+7-919-104-45-94">+7 919-104-45-94</a></div>
								<div class="contact_info_text"><a href="tel:+7-916-124-19-57">+7 916-124-19-57</a></div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Email</div>
								<div class="contact_info_text"><a href="mailto:info@san-royal.ru">info@san-royal.ru</a></div>
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
						<div class="alert alert-success" style="display: none"></div>
            <form method="post" action="{{route('contact')}}" id="contact_form">
              {{-- @method('POST') --}}
              @csrf
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" name="name" class="contact_form_name input_field" placeholder="Имя" required="required" data-toggle="tooltip" data-placement="top" title="Hooray!" />
								<input type="email" name="email" class="contact_form_email input_field" placeholder="Email адресс"  />
								<input type="telephone" name="phone" class="contact_form_phone input_field" placeholder="Номер телефона" />
							</div>
							<div class="contact_form_text">
								<textarea name="message" class="text_field contact_form_message" name="message" rows="4" placeholder="Сообщение" required="required"></textarea>
							</div>
							<div class="contact_form_button">
								<button type="submit" class="button contact_submit_button"><i class="fa fa-spinner ajax-spin" style="display: none"></i>Отправить</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Map -->

	<div class="contact_map mt-4">
		<div id="google_map" class="google_map">
			<div class="map_container">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d69413.19010232904!2d37.55182864539572!3d55.73654933328565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54bb88c866ab3%3A0xbc939fab80b34024!2sKiyevsky+railway+station!5e0!3m2!1sen!2s!4v1556472372015!5m2!1sen!2s" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	@push('scripts')
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script>
				// $('[data-toggle="tooltip"]').tooltip();

        $("#contact_form").submit(function(e){
					$('.contact_submit_button i').show();
          $('.contact_submit_button').attr('disabled', 'disabled');
					$('.alert-success').hide().text('');
					$('.border-danger').removeClass('border-danger')
					e.preventDefault();
          const 
            url = $(this).attr('action'),
            data = new FormData(e.target);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $("[name=_token]").val()
            }
          });
          $.ajax({
            url: url,
            method: 'post',
            type: "POST",
            data: data,
            contentType: false, 
            processData: false,
            success: data => {
							$('.contact_submit_button i').hide();
          		$('.contact_submit_button').removeAttr('disabled');
              if(data.errors){
                data.errors.map(function(e){
                  const parts = e.split('-');
									// $(`[name=${parts[1]}] + .text-danger`).text(parts[0]);
									$(`[name=${parts[1]}]`).addClass('border-danger')
                });
                return false;
							}
							$(".alert-success").show().text(data.success);
							$("#contact_form input, textarea").val('')
            },
            error: error => console.log(error)
          });
        });
      </script> 
	@endpush
@endsection