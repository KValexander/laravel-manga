@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>

		$(function() {
	 		@if(!empty($data->user->background))
	 			background_image('{{$data->user->background}}');
	 		@endif
		});

		function background() {
			var background = $("#background").val();
			background_image(background);
		}

		// AJAX запрос на изменение аватара пользователя
		// =================================
		function ajax_preference_avatar() {
			var avatar = { "avatar": $("#avatar").val() };
			if(avatar.avatar == "") { call_message("Введите URL изображения"); return; }
			$.ajax({
				url: "/personal_area/preference",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: avatar,
				success: function(data) {
					call_message(data.message);
					$(".user_avatar img").attr("src", data.avatar);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// AJAX запрос на изменение пароля
		// ==================================
		function ajax_preference_password() {
			var password = $("#password").val();
			var new_password = $("#new_password").val();
			var confirmation_password = $("#confirmation_password").val();

			if(password == "" || new_password == "" || confirmation_password == "") {
				call_message("Заполните все поля");
				return;
			}

			if(new_password != confirmation_password) {
				call_message("Пароли не совпадают");
				return;
			}

			password = {
				"password": new_password,
			};

			$.ajax({
				url: "/personal_area/preference",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: password,
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// AJAX запрос на изменение основных настроек
		// ===============================
		function ajax_preference_basic() {
			var username = $("#username").val();
			var status = $("#status").val();
			var about = $("#about").val();
			var background = $("#background").val();

			var request = {
				"username" : username,
				"status": status,
				"about": about,
				"background": background,
			};

			$.ajax({
				url: "/personal_area/preference",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: request,
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});

		}
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Настройки</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">
			<h3>Общие настройки:</h3>
			<div class="personal_info">
				<p><input type="text" placeholder = "Введите новое имя" id = "username" value = "{{ $data->user->username }}"> <span>Имя пользователя</span></p>
				<p><input type="text" placeholder = "Введите статус" id = "status" value = "{{ $data->user->status }}"> <span>Статус</span></p>
				<p><input type="text" placeholder = "Ваш логин" value = "{{ $data->user->login }}" disabled> <span>Логин. Никому не виден</span></p>
				<p><input type="text" placeholder = "Ваш email" value = "{{ $data->user->email }}" disabled> <span>Email. Никому не виден</span></p>
			</div>

			<br />

			<h3>О себе:</h3>
			<div class="personal_info">
				<textarea id="about" cols="30" rows="10" id = "about" placeholder = "Краткая информация о себе">{{ $data->user->about }}</textarea>
			</div>

			<br />

			<h3>Задний фон:</h3>
			<div class="personal_info">
				<p><span>Возможность поставить задний фон для страницы. Видимость будет для всех.</span></p>
				<p>
					<input class = "background" id = "background" type="text" placeholder = "Введите URL изображения">
					<input type="button" value = "Поставить" onclick = "background()">
				</p>
			</div>
			<br>
			<p><input type="button" value = "Сохранить" onclick = "ajax_preference_basic()"></p>

		</div>

		<!-- Сайдбар -->
		<div class="wrap_right">
			<div class="user_avatar">
				@if(empty($data->user->avatar))
					<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">
				@else
					<img src="{{ $data->user->avatar }}" alt="">
				@endif
			</div>
			<div class="user_panel">
				<div class = "head">Изменение изображения</div>
				<p><input type="text" id = "avatar" placeholder = "Введите url изображения"></p>
				<p><input type="button" value = "Изменить" onclick = "ajax_preference_avatar()"> </p>
			</div>
			<div class="user_panel">
				<div class = "head">Изменение пароля</div>
				<p><input type="password" id = "password" placeholder = "Текущий пароль"></p>
				<p><input type="password" id = "new_password" placeholder = "Новый пароль"></p>
				<p><input type="password" id = "confirmation_password" placeholder = "Подтвердить пароль"></p>
				<p><input type="button" value = "Изменить пароль" onclick = "ajax_preference_password()"></p>
			</div>
			<div class="user_panel">
				<p><a href="/personal_area/delete">Удалить страницу</a></p>
			</div>
			<div class="user_panel">
				<p><a href="/logout">Выйти</a></p>
			</div>
		</div>
	</div>
@endsection