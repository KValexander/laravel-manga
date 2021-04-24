@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		$(function() {
			post_preview();
		});

		// Функция для вывода контентой части статьи
		// =======================
		function post_preview() {
			var content = `{{ $data->post->post_content }}`;
			var regexp = /[\r\n]+/;

			var arr = content.split(regexp);
			for(var i = 0; i < arr.length; i++) {
				var content = content.replace(regexp, "<p>");
			}

			$("#content").html(content);
		}

		// Функция для добавления и удаления комментария
		// ===========================
		function ajax_comment(type, id_comment) {
			$.ajax({
				url: "/posts/post/{{ $data->post->id_post }}/comment?type="+ type + "&id_comment="+ id_comment +"&comment=" + $("#comment").val(),
				type: "GET",
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			})
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
		<h2 class = "not">{{ $data->post->post_title }} - {{ $data->user->username }}</h2>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">
			<!-- Блок поста -->
			<div class="post">
				<h2>{{ $data->post->post_title }}</h2>
				<div class="post_content">
					<p id = "content"></p>
				</div>
				<p><b>Метки</b>: {{ $data->post->tags }} </p>
			</div>

			<!-- Блок комментариев -->
			<div class="post_comments">
				@if($data->post->type == "post")
					@if(isset($data->comments))
						<h2>Комментарии ({{ count($data->comments) }})</h2>
					@else
						<h2>Комментарии (0)</h2>
					@endif
					@if($access != 0)
						<p><textarea class = "half" id="comment" cols="30" rows="10"></textarea></p>
						<p><input type="button" value = "Добавить комментарий" onclick = "ajax_comment('add', 'null')"></p>
					@else
						<p>Только авторизованные пользователи могут оставлять комментарии</p>
						<p><a href="/login">[Войти]</a><a href="/register">[Зарегистрироваться]</a></p>
					@endif
					<div class="line"></div>
					@if(isset($data->comments))
						@foreach($data->comments as $key => $val)
							<div class="comment">
								@if(!empty($val->avatar)) <img src="{{ $val->avatar }}" alt="">
								@else <img src="{{ asset('manga/images/hollow_star.png') }}" alt=""> @endif
								<p><b><a href="/user/{{ $val->id_user }}">{{ $val->username }}</a></b> | {{ $val->date }} |
								@if($val->id_user == $data->id_user) <i><a onclick = "ajax_comment('delete', '{{ $val->id_comment }}')">Удалить</a></i></p>@endif
								<p>{{ preg_replace('/[\r\n]+/', '<p>', $val->comment) }}</p>
							</div>
						@endforeach
					@else
						<p><i>Комментарии отсутствуют</i></p>
					@endif
				@else
					<p><i>К новостям и событиям комментарии отключены</i></p>
				@endif
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
						<p><a href="/posts/post/{{$data->post->id_post}}/update">Обновить пост</a></p>
						<p><a href="/posts/post/{{$data->post->id_post}}/delete">Удалить пост</a></p>
					</div>
				@endif
			@endif
		</div>

	</div>

	
@endsection