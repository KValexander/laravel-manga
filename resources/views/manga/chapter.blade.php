@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		// Без этой переменной поломается всё
		var i = 0;
		// Получение строки ссылок страниц
		var images = '{{ $data->images }}';
		// Разбиение строки на массив
		images = images.split(",");

		// Отслеживание нажатия клавиш
		$(document).keyup(function(e) {
			if(e.which == 37) left();
			if(e.which == 39) right();
		});

		$(function() {
			out = "";
			// Объявляемые функции
			// ===================
			create_select_page();
			choice_page();
			choice_chapter();

			// Предварительная работа с адресной строкой
			// ========================================
			var params = document.location.search;
			var search = new URLSearchParams(params);

			if(search.has("page")) var page = search.get("page");
			else var page = 0;

			// Работа с адресной строкой
			if(window.history.state == null) {
				i = page;
				select_page(i);
				document.querySelector("#chapter_image").src = images[i];
			} else {
				if(window.history.state.page >= images.length) {
					window.history.state.page = images.length - 1;
					pushState(window.history.state.page);
				}
				i = window.history.state.page;
				document.querySelector("#chapter_image").src = images[i];
				select_page(i);
			}
			// Конец работы с адресной строкой
			// =======================================

			// Работа с куки
			// ==============================
			var cookie = $.cookie("colour");
			if(cookie != null) {
				background_cookie();
			}

			// Вывод общего количества страниц
			// ====================================
			$("span.all_page").html(images.length);

			// Выбор по умолчанию нужной главы
			// ====================================
			var ch = document.querySelector("#chapters").getElementsByTagName("option");
			for(var j = 0; j < ch.length; j++) {
				if(ch[j].value == "{{ $data->volume }}-{{ $data->chapter }}") ch[j].selected = true;
			}
		});

		// Работа с адресной строкой с помощью History API и чуть больше
		// =======================
		function pushState(num) {
			if(num >= images.length) num = num - 1;
			select_page(num);

			$('html, body').animate({scrollTop: 200},100);

			if(window.history.state == null) {
				window.history.pushState({page: num}, '', '?page=' + num);
			} else {
				window.history.replaceState({page: num}, '', '?page=' + num);
			}
			return window.history.state.page;
		}

		// Выбор заднего фона
		// =========================
		function background(color) {
			if (color == "background") { background_image('{{$data->manga->background}}'); }
			if (color != "background") {
				$(".background_mask").html("");
				$("body").css("background", color);
				$("body").css("background-size", "cover");
				$.cookie("colour", color, { expires: 7, path: '/' });
			}
		}

		// Выбор заднего фона сохранённого в cookie
		// ============================
		function background_cookie() {
			var color = $.cookie("colour");
			$(".background_mask").html("");
			$("body").css("background", color);
			$("body").css("background-size", "cover");
		}

		// Переключение страницы при нажатии на изображение
		// ============================
		function use_chapter_images() {
			document.querySelector("#chapter_image").src = "";
			i++;
			pushState(i);
			document.querySelector("#chapter_image").src = images[i];
			if(i >= images.length) transition();
		}
		// Переключение страницы при нажатии на стрелку влево
		// ===============
		function left() {
			document.querySelector("#chapter_image").src = "";
			i--;
			if(i >= images.length || i < 0) i = 0;
			pushState(i);
			document.querySelector("#chapter_image").src = images[i];
		}
		// Переключение страницы при нажатии на стрелку вправо
		// ================
		function right() {
			document.querySelector("#chapter_image").src = "";
			i++;
			pushState(i);
			document.querySelector("#chapter_image").src = images[i];
			if(i >= images.length) transition();
		}

		// Создание options для списка страниц
		// =============================
		function create_select_page() {
			out = ""; var k = 1;
			for (var i = 0; i < images.length ;i++) { out += `<option value = "${i}">${k}</option>`; k++; } k = 1;
			$("#page").html(out);
		}

		// Выбор нужной страницы с каждым переходом по страницам
		// =========================
		function select_page(val) {
			var page = document.querySelector("#page").getElementsByTagName("option");
			page[val].selected = true;
		}

		// Возможность при выборе страницы переключения на неё
		// ======================
		function choice_page() {
			document.querySelector("#page").addEventListener('change', function (event) {
				i = event.target.value;
				pushState(i);
				document.querySelector("#chapter_image").src = "";
				document.querySelector("#chapter_image").src = images[i];
			});
		}

		// Возможность выбора главы из списка
		// =========================
		function choice_chapter() {
			// Переключение главы по выбору из списка
			document.querySelector("#chapters").addEventListener('change', function (event) {
				chapter = event.target.value.split("-");
				document.location.href="/manga/{{ $data->id_manga }}/chapter/"+chapter[0]+"/"+chapter[1];
			});
		}

		// Функция для перехода на следующую главу
		// =====================
		function transition() {
			var chapter = document.querySelector("#chapters").getElementsByTagName("option");
			for(var j = 0; j < chapter.length; j++) {
				if(chapter[j].selected == true) {
					if(chapter[j-1] == undefined) {
						document.location.href="/manga/{{ $data->id_manga }}/";
						return;
					} else {
						chapter = chapter[j-1].value;
					}
				}
			}
			chapter = chapter.split("-");
			document.location.href="/manga/{{ $data->id_manga }}/chapter/"+chapter[0]+"/"+chapter[1];
		}


		// AJAX функция изменения типа закладки
		// =======================================================
		function ajax_bookmark_watching(id_bookmark, type) {
			var params = document.location.search;
			var search = new URLSearchParams(params);
			if(search.has("page")) var page = search.get("page");
			else var page = 0;
			$.ajax({
				url: "/manga/{{ $data->id_manga }}/update/bookmarks/watching?id_bookmark=" + id_bookmark + "&type=" + type + "&volume={{ $data->volume }}&chapter={{ $data->chapter }}&page=" + page,
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
		<select class = "chapters" id="chapters">
			@foreach($data->chapters as $key => $val)
				<option value="{{ $val->volume }}-{{ $val->chapter }}">{{ $val->volume }} - {{ $val->chapter }} {{ $val->chapter_title }}</option>
			@endforeach
		</select>
		<div class="arrow_left" onclick = "left()"></div>

		<p style = "float: left; line-height: 40px;">Страница <select style="width:50px; height: 35px;" id="page"></select> из <span class = "all_page"></span> </p>

		<div class="arrow_right" onclick = "right()"></div>

		<div class="colour">
			<div class="color" id = "color2" onclick = "background('#eee')"></div>
			<div class="color" id = "color1" onclick = "background('white')"></div>
			<div class="color" id = "color3" onclick = "background('#333')"></div>
			<div class="color" id = "color4" onclick = "background('black')"></div>
		 	@if(!empty($data->manga->background))
				<div class="color" id = "color5" onclick = "background('background')"></div>
 			@endif
		</div>
		@if($access != 0)
			@if($data->bookmark == true)
				<div class="chapter_bookmark" title = "Добавить закладку на эту страницу">
					<div class="icon"  onclick = "ajax_bookmark_watching('{{ $data->id_bookmark }}', 'WATCHING')"></div>
					@if(isset($data->bk))
						<span><a href="/manga/{{ $data->id_manga }}/chapter/{{ $data->bk->volume }}/{{ $data->bk->chapter }}?page={{ $data->bk->page }}"><b> {{ $data->bk->volume }} - {{ $data->bk->chapter }} </b></a></span>
					@endif
				</div>
			@else
				<div class="chapter_bookmark" title = "Добавить в закладки" onclick = "ajax_bookmark_watching('null', 'WATCHING')">
					<div class="icon"></div>
				</div>
			@endif
		@endif
	</div>
	<div class="wrap_content">
	<div class="void" style = "height: 50px;" ></div>
		<div class="wrap_chapter">
			<h2><a href="/manga/{{ $data->id_manga }}">{{ $data->manga_name }}</a> {{ $data->volume }} - {{ $data->chapter }} {{ $data->chapter_title }}</h2>
			<div class="chapter_image">
				<img id="chapter_image" src="" alt="" onclick = "use_chapter_images()">
			</div>
		</div>
	</div>
@endsection