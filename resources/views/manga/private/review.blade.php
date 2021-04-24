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
		<h1>Ваши рецензии</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">

			<h3>Последние рецензии</h3>
			<div class="personal_info">
				<p>Общее количество рецензий: <b>{{ $data->review_count }}</b></p>
				<div class="private_reviews">
					@if($data->reviews == 0)
						<p><i>Рецензии отсутствуют</i></p>
					@else
						@foreach($data->reviews as $key => $val)
						<div class="review">
							Рецензия <a href="/reviews/review/{{ $val->id_review }}">{{ $val->review_title }}</a> на мангу <a href="/manga/{{ $val->id_manga }}">{{ $val->manga_title }}</a>
							<p>
								{{ $val->date }}| <a href="/user/{{ $val->id_user }}">{{ $val->username }}</a> | Оценка: {{ $val->rating }}/10
								| <a href="/review/update?id_review={{ $val->id_review }}">Изменить</a> | <a href="/review/delete?id_review={{ $val->id_review }}">Удалить</a>
							</p>
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
				<p><a href="">Рецензии</a></p>
			</div>
			<div class="user_panel">
				<p><a href="/personal_area/preference">Настройки</a></p>
				<p><a href="/user/{{ $data->user->id }}">Публичная страница</a></p>
			</div>
		</div>
	</div>
@endsection