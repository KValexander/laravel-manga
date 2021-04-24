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
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Ваши сообщения</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">
			<h3>Ваши диалоги</h3>
			<div class="personal_info">
				@if(count($data->dialogs) == 0)
					<p><i>Диалоги отсутствуют. Напишите своим <a href="/personal_area/friend">друзьям</a> чтобы начать диалог</i></p>
				@else
					@foreach($data->dialogs as $key => $val)
						<div class="dialogs" onclick = "document.location.href='/personal_area/message/dialog?id_interlocutor={{ $val->id_second }}'">
							<p><b><a href="/user/{{ $val->id_first }}">{{ $val->first_username }}</a> - <a href="/user/{{ $val->id_second }}">{{ $val->second_username }}</a></b></p>
							@if($val->last_message == 0)
								<p class = "text" style = "color: gray">Сообщения отсутствуют</p>
							@else
								<p class = "text">{{ $val->last_message }}</p>
							@endif
						</div>

					@endforeach
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