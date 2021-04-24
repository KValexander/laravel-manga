@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		function ajax_register() {
			if($("#password").val() != $("#verifed_password").val()) {
				call_message("Пароли не совпадают");
				return;
			}
			$.ajax({
				url: "/register",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: $("form").serialize(),
				success: function(data) {
					call_message(data.message);
					$('form')[0].reset();
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
		<h1>Регистрация</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма регистрации</h2>
		<form>
			<p><input type="text" name = "login" placeholder = "Введите логин"></p>
			<p><input type="text" name = "username" placeholder = "Введите имя"></p>
			<p><input type="text" name = "email" placeholder = "Введите email"></p>
			@if($access == "1" || $access == "2")
				<p><select name="access">
					<option selected disabled>Выберите вашу роль</option>
					@if($access == "1")
						<option value="1">Администратор</option>
						<option value="2">Модератор</option>
					@endif
					<option value="3">Редактор</option>
					<option value="4">Пользователь</option>
				</select></p>
			@endif
			<p><input type="password" name = "password" id = "password" placeholder = "Введите пароль"></p>
			<p><input type="password" id = "verifed_password" placeholder = "Подтвердите пароль"></p>
			<p><input type="button" value = "Зарегистрироваться" onclick = "ajax_register()"></p>
		</form>
	</div>
@endsection