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

		// AJAX запрос на удаление комментария
		function ajax_delete_comment(id_manga,id_comment) {
			$.ajax({
				url: "/manga/" + id_manga + "/delete/comment?id_comment=" + id_comment,
				type: "GET",
				success: function(data) {
					document.location.href = "";
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
		<h1>Личный кабинет</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">

			<h3>Общая информация</h3>
			<div class="personal_info">
				<p>Имя пользователя: <b>{{ $data->user->username }}</b></p>
				<p>Статус: @if(!empty($data->user->status)) <b>{{ $data->user->status}}</b> @else <i>Информация отсутствует</i> @endif</p>
				<p>Логин: <b>{{ $data->user->login }}</b></p>
				<p>О себе: 
				@if(!empty($data->user->about))
					</p><p><i>{{ $data->user->about }}</i></p>
				@else
					<i>Информация отсутствует</i></p>
				@endif
			</div> <br>

			<h3>Последние отзывы:</h3>
			<div class="personal_info">
				<p>Общее количество отзывов: <b>{{ $data->ratings_count }}</b></p>
				<div class="user_ratings">
					@if($data->ratings == 0)
						<p><i>Отзывы отсутствуют</i></p>
					@else
						@foreach($data->ratings as $key => $val)
						<div class="rating">
							<p class = "name"><a href="/manga/{{ $val->id_manga }}">{{ $val->manga_name }}</a></p>
							<p>{{ $val->rating }}/10</p>
						</div>
						@endforeach
					@endif
				</div>
			</div> <br>

			<h3>Последние комментарии к манге:</h3>
			<div class="personal_info">
				<p>Общее количество комментариев: <b>{{ $data->comments_count }}</b></p>
				<div class="comments">
					@if($data->comments == 0)
						<p><i>Комментарии отсутствуют</i></p>
					@else
						@foreach($data->comments as $key => $val)
						<div class="comment">
							<p><b><a href="/user/{{ $val->id_user }}">{{ $val->username }}</b></a> <a href="/manga/{{ $val->id_manga }}#comments">({{ $val->manga_name }})</a> {{ $val->date }} <i><a style = "cursor: pointer" onclick = "ajax_delete_comment('{{ $val->id_manga }}','{{ $val->id_comment }}')">Удалить</a></i></p>
							<p>{{ $val->comment }}</p>
							<p><a href="/manga/{{ $val->id_manga }}#comments"><i>Посмотреть</i></a></p>
						</div>
						@endforeach
					@endif
				</div>
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