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
		<h2>Пользователь - {{ $data->user->username }}</h2>
		<p>Статус: @if(!empty($data->user->status)) <b>{{ $data->user->status}}</b> @else <i>Информация отсутствует</i> @endif</p>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">

			<h3>О себе:</h3>
			<div class="personal_info">
				@if(!empty($data->user->about))
					<p><i>{{ $data->user->about }}</i></p>
				@else
					<i>Информация отсутствует</i>
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
							<p><b><a href="/user/{{ $val->id_user }}">{{ $val->username }}</b></a> <a href="/manga/{{ $val->id_manga }}#comments">({{ $val->manga_name }})</a> {{ $val->date }}</p>
							<p>{{ $val->comment }}</p>
							<p><a href="/manga/{{ $val->id_manga }}#comments"><i>Посмотреть</i></a></p>
						</div>
						@endforeach
					@endif
				</div>
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
				@if($data->user->online == 1)
					<b><p style = "color: green">В сети</p></b>
				@else
					<b><p style = "color: gray">Не в сети</p></b>
				@endif
				@if($data->friends == false)
					<p><a onclick = "ajax_friend('add')">Добавить в друзья</a></p>
				@else
					<p style = "cursor: default">Ваш друг</p>
					<p><a onclick = "ajax_friend('delete')">Удалить из друзей</a></p>
				@endif
				<p><a href="/personal_area/message/dialog?id_interlocutor={{ $data->user->id }}">Написать сообщение</a></p>
			</div>
		</div>
	</div>
@endsection