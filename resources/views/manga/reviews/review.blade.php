@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>

		$(function() {
			// Вызов функций
			review_content();
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

			$(".review_content").html(content);
		}

		// Вывод количества звёзд оценки пользователем манги
		// ===========================
		function rating_out(rating) {
			for (var i = 0; i < rating; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
		}

		// AJAX запрос на добавление и удаление друзей
		// ==========================
		function ajax_friend(type) {
			$.ajax({
				url: "/user/{{ $data->user->id }}/friend?type=" + type,
				type: "GET",
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
		<h2 style = "margin: 0">{{$data->review->review_title}} - <a href="/manga/{{ $data->manga->id_manga }}">{{ $data->manga->russian_name }}</a></h2>
	</div>

	<div class="wrap_content">
		<div class="wrap_left">
			<div class="review_single">
				<h2>{{$data->review->review_title}}</h2>

				<div class="review_content"></div>
				<p>Оценка пользователя:</p>
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
				<p><i>Дата написания:</i> {{ $data->date }}</p>
			</div>
		</div>

		<div class="wrap_right">
			<div class="user_avatar">
				@if(empty($data->user->avatar))
					<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">
				@else
					<img src="{{ $data->user->avatar }}" alt="">
				@endif
			</div>
			<div class="user_panel">
				<b><p><a href="/user/{{ $data->user->id }}">{{ $data->user->username }}</a></p></b>
				@if($access == 0)
					<p><a onclick = "call_message('Вы не авторизованы')">Добавить в друзья</a></p>
					<p><a onclick = "call_message('Вы не авторизованы')">Написать сообщение</a></p>
				@else
					@if($data->friends == false)
						<p><a onclick = "ajax_friend('add')">Добавить в друзья</a></p>
					@else
						<p style = "cursor: default">Ваш друг</p>
						<p><a onclick = "ajax_friend('delete')">Удалить из друзей</a></p>
					@endif
					<p><a>Написать сообщение</a></p>
				@endif
			</div>

			@if($access != 0)
				@if($username == $data->user->username)
					<div class="user_panel">
						<p><a href="/review/update?id_review={{ $data->review->id_review }}">Обновить рецензию</a></p>
						<p><a href="/review/delete?id_review={{ $data->review->id_review }}">Удалить рецензию</a></p>
					</div>
				@endif
			@endif

		</div>
	</div>
@endsection