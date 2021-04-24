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

		// AJAX запрос на удаление друзей
		// ==========================
		function ajax_friend_delete(user_id, type, re) {
			$.ajax({
				url: "/user/" + user_id + "/friend?type=" + type + re,
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
		<h1>Ваши друзья</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">
			<h3>Ваши друзья</h3>
			<div class="personal_info">
				@if($data->friends == 0)
					<p><i>Друзья отсутствуют</i></p>
				@else
					<p>Общее количество: {{ $data->friends_count }}</p>
					<div class="friends">
						@foreach($data->friends as $key => $val)
							<div class="friend">
								<p class = "float"><a href="/user/{{ $val->id_user }}">{{ $val->username }}</a></p>
								<p style = "cursor: pointer"><a onclick = "ajax_friend_delete('{{ $val->id_user }}', 'delete', '')">Удалить</a></p>
							</div>
						@endforeach
					</div>
				@endif
			</div>
			<br>
			<h3>Вы в друзьях</h3>
			<div class="personal_info">
				@if($data->re_friends == 0)
					<p><i>Никто вас не добавил в друзья</i></p>
				@else
					<p>Общее количество: {{ $data->re_friends_count }}</p>
					<div class="friends">
						@foreach($data->re_friends as $key => $val)
							<div class="friend">
								<p class = "float"><a href="/user/{{ $val->id_user }}">{{ $val->username }}</a></p>
								<p style = "cursor: pointer"><a onclick = "ajax_friend_delete('{{ $val->id_user }}', 'delete','&re=1')">Удалить</a></p>
							</div>
						@endforeach
					</div>
				@endif
			</div>
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
				@if($data->user->online == 1)
					<b><p style = "color: green">В сети</p></b>
				@else
					<b><p style = "color: gray">Не в сети</p></b>
				@endif
				<p><a href="/personal_area">Личный кабинет</a></p>
				<p><a href="/personal_area/message">Сообщения</a></p>
				<p><a href="/personal_area/bookmarks">Закладки</a></p>
				<p><a href="/personal_area/friend">Друзья</a></p>
				<p><a href="/personal_area/post">Посты</a></p>
				<p><a href="/personal_area/review">Рецензии</a></p>
			</div>
			<div class="user_panel">
				<p><a href="/personal_area/preference">Настройки</a></p>
				<p><a href="/user/{{ $data->user->id }}">Публичная страница</a></p>
			</div>
		</div>
	</div>
@endsection