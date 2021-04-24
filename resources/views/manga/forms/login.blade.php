@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		function ajax_login() {
			$.ajax({
				url: "/login",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: $("form").serialize(),
				success: function(data) {
					document.location.href = '/';
				},
				error: function(jqXHR) {
					call_message(JSON.parse(jqXHR.responseText));
				}
			});
		}
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Авторизация</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма авторизации</h2>
		<form onsubmit="ajax_login()">
			<p><input type="text" name = "login" placeholder = "Введите логин"></p>
			<p><input type="password" name = "password" placeholder = "Введите пароль"></p>
			<p><input type="button" value = "Войти" onclick = "ajax_login()"></p>
		</form>
	</div>
@endsection