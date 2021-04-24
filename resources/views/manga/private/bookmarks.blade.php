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

		// AJAX функция изменения типа закладки
		function ajax_bookmark_type(id_manga, id_bookmark, type) {
			$.ajax({
				url: "/manga/" + id_manga + "/update/bookmarks?id_bookmark=" + id_bookmark + "&type=" + type,
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
		<h1>Ваши закладки</h1>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">

			<h3>В планах</h3>
			<div class="personal_info">
			<p>Общее количество: <b>{{ $data->count_planed }}</b></p>
				<div class="bookmarks">
					@if($data->count_planed == 0)
						<p><i>Закладки отсутствуют</i></p>
					@else
						@foreach($data->planed as $key => $val)
							<div class="bookmark">
								<p class = "float"><a href="/manga/{{ $val->id_manga }}">{{ $val->manga_name }}</a></p>
								<div class="icons">
									<div class="icon" id = "planed" title = "Добавить в планы" onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'PLANED')"></div>
									<div class="icon" id = "watching" title = "Добавить в процессе"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'WATCHING')"></div>
									<div class="icon" id = "completed" title = "Добавить в прочитано"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'COMPLETED')"></div>
									<div class="icon" id = "favorite" title = "Добавить в любимое"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'FAVORITE')"></div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

			<br />

			<h3>В процессе</h3>
			<div class="personal_info">
			<p>Общее количество: <b>{{ $data->count_watching }}</b></p>
				<div class="bookmarks">
					@if($data->count_watching == 0)
						<p><i>Закладки отсутствуют</i></p>
					@else
						@foreach($data->watching as $key => $val)
							<div class="bookmark">
								<p class = "float">
									<a href="/manga/{{ $val->id_manga }}">{{ $val->manga_name }}</a><a href="/manga/{{ $val->id_manga }}/chapter/{{ $val->volume }}/{{ $val->chapter }}?page={{ $val->page }}"><b>{{ $val->volume }} - {{$val->chapter}}</b></a>
								</p>
								<div class="icons">
									<div class="icon" id = "planed" title = "Добавить в планы" onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'PLANED')"></div>
									<div class="icon" id = "watching" title = "Добавить в процессе"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'WATCHING')"></div>
									<div class="icon" id = "completed" title = "Добавить в прочитано"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'COMPLETED')"></div>
									<div class="icon" id = "favorite" title = "Добавить в любимое"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'FAVORITE')"></div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

			<br />

			<h3>Прочитано</h3>
			<div class="personal_info">
			<p>Общее количество: <b>{{ $data->count_completed }}</b></p>
				<div class="bookmarks">
					@if($data->count_completed == 0)
						<p><i>Закладки отсутствуют</i></p>
					@else
						@foreach($data->completed as $key => $val)
							<div class="bookmark">
								<p class = "float"><a href="/manga/{{ $val->id_manga }}">{{ $val->manga_name }}</a></p>
								<div class="icons">
									<div class="icon" id = "planed" title = "Добавить в планы" onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'PLANED')"></div>
									<div class="icon" id = "watching" title = "Добавить в процессе"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'WATCHING')"></div>
									<div class="icon" id = "completed" title = "Добавить в прочитано"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'COMPLETED')"></div>
									<div class="icon" id = "favorite" title = "Добавить в любимое"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'FAVORITE')"></div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

			<br />

			<h3>Любимое</h3>
			<div class="personal_info">
			<p>Общее количество: <b>{{ $data->count_favorite }}</b></p>
				<div class="bookmarks">
					@if($data->count_favorite == 0)
						<p><i>Закладки отсутствуют</i></p>
					@else
						@foreach($data->favorite as $key => $val)
							<div class="bookmark">
								<p class = "float"><a href="/manga/{{ $val->id_manga }}">{{ $val->manga_name }}</a></p>
								<div class="icons">
									<div class="icon" id = "planed" title = "Добавить в планы" onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'PLANED')"></div>
									<div class="icon" id = "watching" title = "Добавить в процессе"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'WATCHING')"></div>
									<div class="icon" id = "completed" title = "Добавить в прочитано"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'COMPLETED')"></div>
									<div class="icon" id = "favorite" title = "Добавить в любимое"  onclick = "ajax_bookmark_type('{{ $val->id_manga }}', '{{ $val->id_bookmark }}', 'FAVORITE')"></div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>

			<br />

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