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
		function ajax_comment(id_post, type, id_comment) {
			$.ajax({
				url: "/posts/post/"+id_post+"/comment?type="+type+"&comment=null&id_comment="+id_comment,
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
		<h1>Ваши посты</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">

			<h3>Последние посты</h3>
			<div class="personal_info">
				@if($data->posts_count == 0)
					<p><i>Посты отсутствуют</i></p>
				@else
					@foreach($data->posts as $key => $val)
						<div class="private_posts">
							<div class="p_post">
								<p class = "float"><a href="/posts/post/{{ $val->id_post }}">{{ $val->post_title }}</a></p>
								<p><a href="/posts/post/{{ $val->id_post }}/update">Изменить</a> | <a href="/posts/post/{{ $val->id_post }}/delete">Удалить</a></p>
							</div>
						</div>
					@endforeach
				@endif
			</div>

			<br />

			<h3>Последние комментарии к постам</h3>
			<div class="personal_info">
				<p>Общее количество комментариев: <b>{{ $data->comments_count }}</b></p>
				<div class="comments">
					@if($data->comments == 0)
						<p><i>Комментарии отсутствуют</i></p>
					@else
						@foreach($data->comments as $key => $val)
						<div class="comment">
							<p><b><a href="/user/{{ $val->id_user }}">{{ $val->username }}</b></a> <a href="/posts/post/{{ $val->id_post }}">({{ $val->post_title }})</a> {{ $val->date }} <i><a style = "cursor: pointer" onclick = "ajax_comment('{{ $val->id_post }}', 'delete','{{ $val->id_comment }}')">Удалить</a></i></p>
							<p>{{ $val->comment }}</p>
							<p><a href="/posts/post/{{ $val->id_post }}"><i>Посмотреть</i></a></p>
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