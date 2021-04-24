@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>

		$(function() {
			rating_out('{{ $data->rating }}');
		});

		// Функция для вывода контента рецензии
		// =========================
		function review_content() {
			var content = `{{ $data->review->review_content }}`;
			var regexp = /[\r\n]+/;

			var arr = content.split(regexp);
			for(var i = 0; i < arr.length; i++) {
				var content = content.replace(regexp, "<p>");
			}

			// $(".review_content").html(content);
		}

		// Вывод количества звёзд оценки пользователем манги
		// ===========================
		function rating_out(rating) {
			for (var i = 0; i < rating; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
		}

		// AJAX запрос на обновление рецензии
		// ========================
		function review_update() {
			var data = {
				"id_review": "{{ $data->review->id_review }}",
				"review_title": $("#title").val(),
				"review_content": $("#content").val(),
			};
			$.ajax({
				url: "/review/update",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: data,
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
		<h1>Страница обновления рецензии</h1>
	</div>
	<div class="wrap_content">
		<h2 style = "margin: 0">Обновление рецензии на мангу <a href="/manga/{{ $data->manga->id_manga }}">{{ $data->manga->russian_name }}</a></h2>
	</div>

	<div class="wrap_content">
		<div class="wrap_left">
			<h2>Форма обновления</h2>
			<form onsubmit = "review_update()">
				<p><input value = "{{ $data->review->review_title }}" type="text" name = "review_title" id = "title" placeholder = "Заголовок для рецензии"></p>
				<p><textarea style = "height: 300px;" name="review_content" id = "content" placeholder = "Содержание рецензии" id="" cols="30" rows="10">{{ $data->review->review_content }}</textarea></p>
				<h3 style = "margin-bottom: 0">Ваша оценка:</h3>
				<div style = "height: 40px;" class="ratings">
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating0"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating1"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating2"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating3"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating4"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating5"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating6"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating7"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating8"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating9"></div>
				</div>
				<p><input type="button" value = "Обновить рецензию" onclick = "review_update()"></p>
			</form>
		</div>
		<div class="wrap_right">
			<!-- <div class="review_panel"> -->
				<div class="user_avatar">
					@if(empty($data->user->avatar))
						<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">
					@else
						<img src="{{ $data->user->avatar }}" alt="">
					@endif
				</div>
				<div class="user_panel">
					<p style = "cursor: default"><b>{{ $data->user->username }}</b></p>
					<p><a href="/personal_area">Личный кабинет</a></p>
				</div>
			<!-- </div> -->
		</div>
	</div>
@endsection