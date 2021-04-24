@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		var k = 1;

		@if(isset($data->rating_integer))
			var average = '{{ $data->rating_integer }}';
		@else
			var average = 0;
		@endif
		$(function() {
			cover_image();
			rating_star();

	 		@if(!empty($data->manga->background))
	 			background_image('{{$data->manga->background}}');
	 		@endif

			@php $img = explode(",", $data->manga->images); @endphp
			@if(count($img) >= 2)
				k = 1;
				var timer = setInterval(function() { slide(k); }, 5000);
				setTimeout(() => { clearInterval(timer); }, 35100);
			@endif
		});

		function cover_image() {
			var images = '{{ $data->manga->images }}';
			images = images.split(",");
			out = "";
			for(var i = 0; i < images.length; i++) {
				if(k == images.length) k = 0;
				out += `<img id = "slide${i}" src="${images[i]}", alt="${images[i]}" onclick = "slide(${k})" />`;
				k++;
			}
			$("div.cover_image").html(out);
			slide(0);
		}

		function slide(id) {
			var count = $("div.cover_image img").length;
			for(var i = 0; i < count; i++) {
				$("#slide"+ i).fadeOut(500);
			}
			k++;
			if(k == count) k = 0;
			$("#slide"+id).fadeIn(500);
		}

		function rating_star() {
			for(var i = 0; i < average; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
		}

		function rating_star_enter(count) {
			for(var i = 0; i < count; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
			var length = $(".count").length;
			for(var i = count; i < length; i++) {
				$("#rating"+i).removeClass("full_rating");
				$("#rating"+i).addClass("hollow_rating");
			}
		}

		function rating_star_leave() {
			var count = $(".count").length;
			for(var i = 0; i < average; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
			for(var i = average; i < count; i++) {
				$("#rating"+i).removeClass("full_rating");
				$("#rating"+i).addClass("hollow_rating");
			}
		}

		// AJAX запрос на добавление оценки манге
		// ==========================
		function ajax_rating(score) {
			$.ajax({
				url:"/manga/{{$data->manga->id_manga}}/rating?score="+score,
				type: "GET",
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(JSON.parse(jqXHR.responseText).message);
				}
			});
		}

		// AJAX запрос на добавление закладки
		// ===========================
		function ajax_add_bookmark() {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/add/bookmarks",
				type: "GET",
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// AJAX запрос на удаление закладки
		// ==============================
		function ajax_delete_bookmark() {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/delete/bookmarks",
				type: "GET",
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// AJAX запрос на добавление комментария
		// ==========================
		function ajax_add_comment() {
			var comment = $("#comment").val();
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/add/comment?comment=" + comment,
				type: "GET",
				success: function(data) {
					$("#comment").val("");
					call_message(data.message);
					update_comments(data.comments);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// AJAX запрос на удаление комментария
		// ===============================
		function ajax_delete_comment(id) {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/delete/comment?id_comment=" + id,
				type: "GET",
				success: function(data) {
					$("#comment").val("");
					call_message(data.message);
					update_comments(data.comments);
				},
				error: function(jqXHR) {
					call_message(JSON.parse(jqXHR.responseText));
				}
			});
		}

		// Функция обновления комментариев после действий с ними
		// =============================
		function update_comments(data) {
			console.log(data);
			out = "";
			for(var i = 0; i < data.length; i++) {
				out += `
					<div class="comment">
						<div class="user">`;
				if(data[i].avatar != null) out += `<img src="${data[i].avatar}" alt="">`;
				else out += `<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">`;
				out += `</div>
						<div class="text">
							<p><b><a href="/user/${data[i].id_user}">${data[i].username}</a></b> ${data[i].date}</p>
							<p class = "cm">${data[i].comment}</p>
						</div>
					</div>
				`;
			}
			$("#comments").html(out);
		}

		// AJAX функция изменения типа закладки
		// =======================================================
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
		<div class="manga">
			<!-- Чисто пустота на 50px высоты -->
			<div class="void" style = "height: 50px;" ></div>
			<div class="wrap_left">
				<!-- Категория и название манги -->
				@if(empty($data->manga->english_name))
					<h1><span class = "category">{{ $data->manga->category }}</span> {{ $data->manga->russian_name }}</h1>
				@else
					<h1><span class = "category">{{ $data->manga->category }}</span> {{ $data->manga->russian_name }} / {{ $data->manga->english_name }}</h1>
				@endif

				<!-- Обложка манги -->
				<div class="cover_image"></div>

				<!-- Блок взаимодействия пользователя с мангой -->
				<div class="manga_actions">
					<!-- Блок оценки -->
					<div class="ratings">
						<div class = "hollow_rating count" id = "rating0" onclick = "ajax_rating('1')" onmouseenter="rating_star_enter('1')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating1" onclick = "ajax_rating('2')" onmouseenter="rating_star_enter('2')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating2" onclick = "ajax_rating('3')" onmouseenter="rating_star_enter('3')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating3" onclick = "ajax_rating('4')" onmouseenter="rating_star_enter('4')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating4" onclick = "ajax_rating('5')" onmouseenter="rating_star_enter('5')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating5" onclick = "ajax_rating('6')" onmouseenter="rating_star_enter('6')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating6" onclick = "ajax_rating('7')" onmouseenter="rating_star_enter('7')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating7" onclick = "ajax_rating('8')" onmouseenter="rating_star_enter('8')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating8" onclick = "ajax_rating('9')" onmouseenter="rating_star_enter('9')" onmouseleave="rating_star_leave()"></div>
						<div class = "hollow_rating count" id = "rating9" onclick = "ajax_rating('10')" onmouseenter="rating_star_enter('10')" onmouseleave="rating_star_leave()"></div>
					</div>

					@if($data->bookmark == true)
						<div class="icons">
							<div class="icon" id = "planed" title = "Добавить в планы" onclick = "ajax_bookmark_type('{{ $data->manga->id_manga }}','{{ $data->id_bookmark }}', 'PLANED')"></div>
							<div class="icon" id = "watching" title = "Добавить в процессе" onclick = "ajax_bookmark_type('{{ $data->manga->id_manga }}','{{ $data->id_bookmark }}', 'WATCHING')"></div>
							<div class="icon" id = "completed" title = "Добавить в прочитано" onclick = "ajax_bookmark_type('{{ $data->manga->id_manga }}','{{ $data->id_bookmark }}', 'COMPLETED')"></div>
							<div class="icon" id = "favorite" title = "Добавить в любимое" onclick = "ajax_bookmark_type('{{ $data->manga->id_manga }}','{{ $data->id_bookmark }}', 'FAVORITE')"></div>
						</div>
					@endif

					<!-- Блок нажатия чтения глав -->
					@if(!empty($data->chapter))
						<p><input type="button" value = "Читать с первой главы" onclick = "document.location.href='/manga/{{$data->manga->id_manga}}/chapter/{{$data->first->volume}}/{{$data->first->chapter}}'"></p>

						@if(isset($data->bk))
							<h3><a href="/manga/{{ $data->manga->id_manga }}/chapter/{{ $data->bk->volume }}/{{ $data->bk->chapter }}?page={{ $data->bk->page }}">Продолжить {{ $data->bk->volume }} - {{ $data->bk->chapter }}</a></h3>
						@endif
						
						<h3><a href="/manga/{{$data->manga->id_manga}}/chapter/{{ $data->chapter->volume }}/{{ $data->chapter->chapter }}">Читать {{ $data->chapter->volume }} - {{ $data->chapter->chapter }}</a></h3>
					@else
						<p style ="color: gray; font-size: 16pt"><i>Главы отсутствуют</i></p>
					@endif
				</div>

				<!-- Блок информации о манге -->
				<div class="manga_information">
					<h2>Информация о манге</h2>
					<p><b>Томов:</b> {{ $data->manga->volume }}, {{ $data->manga->release }} </p>
					<p><b>Перевод:</b> {{ $data->manga->translation }}</p>
					<p><b>Категория:</b> {{ $data->manga->category }}</p>
					<p><b>Жанры:</b> {{ $data->manga->genres }}</p>
					<p><b>Автор:</b> {{ $data->manga->author }}</p>
					<p><b>Год выпуска:</b> {{ $data->manga->year_of_issue }}</p>
					<p><b>Переводчики:</b> {{ $data->manga->translators }}</p>
				</div>

				<!-- Блок описания манги -->
				<div class="manga_description">
					<h2>Описание</h2>
					<p>{{ $data->manga->description }}</p>
				</div>

				<!-- Блок рецензий манги -->
				<div class="manga_reviews">
					<h2>Последние рецензии</h2>
					<div class="chapters_content">
						@if(isset($data->reviews))
							@foreach($data->reviews as $key => $val)
								<div class="review">
									Рецензия <a href="/reviews/review/{{ $val->id_review }}">{{ $val->review_title }}</a> на мангу <a href="/manga/{{ $val->id_manga }}">{{ $val->manga_title }}</a>
									<p>{{ $val->date }}| <a href="/user/{{ $val->id_user }}">{{ $val->username }}</a> | Оценка: {{ $val->rating }}/10</p>
								</div>
							@endforeach
						@else
							<p style = "color: gray; font-size: 16pt"><i>Рецензии отсутствуют</i></p>
						@endif
					</div>
				</div>

				<!-- Блок глав манги -->
				<h2>Все главы</h2>
				<div class="chapters_content">
					@if(count($data->chapters) != 0)
						@foreach($data->chapters as $key => $val)
							<div class="chapter">
								<p><a href="/manga/{{$data->manga->id_manga}}/chapter/{{$val->volume}}/{{$val->chapter}}">{{$data->manga->russian_name}} {{ $val->volume }} - {{ $val->chapter }} {{ $val->chapter_title }} </a></p>
							</div>
						@endforeach
					@else
						<p style = "color: gray; font-size: 16pt"><i>Главы отсутствуют</i></p>
					@endif
				</div>

				<!-- Блок комментариев -->
				<h2 style = "margin-top: 40px;">Комментарии: (@if(!empty($data->comments)){{ count($data->comments)}}@else 0 @endif)</h2>
				<div class="manga_comments">
					@if($access == "0")
						<p>Только авторизованные пользователи могут оставлять комментарии</p>
						<p><a href="/login">[Войти]</a><a href="/register">[Зарегистрироваться]</a></p>
					@else
						<p><textarea class = "comment" id="comment" cols="40" rows="10" placeholder = "Оставить комментарий"></textarea></p>
						<p><input type="button" value = "Добавить" onclick = "ajax_add_comment()"></p>
					@endif
					<div class="line"></div>
					<div id="comments">
						@if(!empty($data->comments))
							@foreach($data->comments as $key => $val)
								<div class="comment">
									<div class="user">
										@if(!empty($val->avatar)) <img src="{{ $val->avatar }}" alt="">
										@else <img src="{{ asset('manga/images/hollow_star.png') }}" alt=""> @endif
									</div>
									<div class="text">
										<p><b><a href="/user/{{$val->id_user}}">{{ $val->username }}</a></b> {{$val->date}}
											@if($val->id_user == $data->id_user) <span><a style = "cursor: pointer;" onclick = "ajax_delete_comment('{{ $val->id_comment }}')"><i>Удалить</i></a></span> @endif
										</p>
										<p class = "cm">{{ $val->comment }}</p>
									</div>
								</div>
							@endforeach
						@else
							<h3>Комментарии отсутствуют</h3>
						@endif
					</div>
				</div>

			</div>

			<!-- Сайдбар -->
			<div class="wrap_right">
				<!-- Статистика манги -->
				<h2>Статистика</h2>
				@if($access != "0")
					<div class="line"></div>
					<!-- Всякие действия -->
					<p><b>Действия:</b></p>
					<div class="stat">
						@if($data->bookmark != true)
							<p><a onclick = "ajax_add_bookmark()">Добавить в закладки</a></p>
						@else
							<p><a onclick = "ajax_delete_bookmark()">Удалить из закладок</a></p>
						@endif
						<p><a href="/review/add?id_manga={{ $data->manga->id_manga }}">Написать рецензию</a></p>
						@if($access == "3" || $access == "2" || $access == "1")
							<p><a href="/manga/{{$data->manga->id_manga}}/update">Обновить информацию</a></p>
							<p><a href="/manga/{{$data->manga->id_manga}}/add/chapter">Добавить главу</a></p>
							@if($access == "2" || $access == "1")
								<p><a href="/manga/{{$data->manga->id_manga}}/delete">Удалить мангу</a></p>
							@endif
						@endif
					</div>
					<div class="line"></div>
				@endif
				<!-- Информация о рейтинге -->
				@if(isset($data->rating_integer))
					<p><b>Рейтинг:</b></p>
					<p>Рейтинг <b>{{ $data->rating_fractional }}/10</b>; Голосов: <b>{{ $data->rating_count }}</b></p>
					<div class="line"></div>
				@endif
				<!-- Информаци о закладках -->
				<p><b>Количество закладок:</b></p>
				<p>В планах: <b>{{ $data->count_planned }}</b></p>
				<p>В процессе: <b>{{ $data->count_watching }}</b></p>
				<p>Прочитано:  <b>{{ $data->count_completed }}</b></p>
				<p>Любимое: <b>{{ $data->count_favorite }}</b></p>
			</div>
		</div>
	</div>
@endsection