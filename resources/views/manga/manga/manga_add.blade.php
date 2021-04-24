@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
	 	var k = 1;

	 	$(function() {
	 		@if(!empty($data->manga->background))
	 			background_image('{{$data->manga->background}}');
	 		@endif
	 	});

	 	// Функция добавления обложки к полю с обложками
	 	// ====================
	 	function add_cover() {
	 		var url = $("#cover").val();
	 		if(url == "") return;
	 		if($("#images").val() == "") out = url;
	 		else out = "," + url;
	 		document.querySelector("#images").value += out;
	 	}

	 	// Функция удаления последней обложки
	 	// =======================
	 	function delete_cover() {
	 		var covers = $("#images").val();
	 		if(covers == "") return;
	 		covers = covers.split(",");
	 		covers.pop();
	 		covers = covers.join(",");
	 		document.querySelector("#images").value = covers;
	    // var products = string.split(',');
	    // products.pop();
	    // return products.join(',');
	 	}

	 	// Функция добавления жанра к полю с жанрами
	 	// ====================
		function add_genre() {
			var choice = $("#genre").val();
			if($("#genres").val() == "") out = choice;
			else out = ", " + choice;
			document.querySelector("#genres").value += out;
		}

		// AJAX запрос на добавление манги
		// =========================
		function ajax_add_manga() {
			$.ajax({
				url: "/add/manga",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: $("form").serialize(),
				success: function(data) {
					call_message(data.message);
					$("form").reset();
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// Функция просмотра заднего фона выбранным изображением
		// =============================
		function preview_background() {
			var url = $("#background").val();
			background_image(url);
		}

		// Функция вывода изображений обложки для предпросмотра
		// ========================
		function preview_cover() {
			var images = $("#images").val();
			if(images == "") return;
			images = images.split(',');
			out = ""; css = "";
			for(var i = 0; i < images.length; i++) {
				if(k == images.length) k = 0;
				out += `<img id = "slide${i}" src = "${images[i]}" alt = "${images[i]}" onclick = "slide(${k})" />`;
				css += `<div class = "touch_slide" onclick = "slide(${i})"></div>`;
				k++;
			}
			$("div.preview_cover").html(out).css("min-height", "410px");
			$("div.touch_cover").html(css);
			slide(0);
		}

		// Функция изменения изображения в зависимости от передаваемого id
		// ==================
		function slide(id) {
			var count = $("div.preview_cover img").length;
			for(var i = 0; i < count; i++) {
				$("#slide"+ i).fadeOut(500);
			}
			$("#slide"+id).fadeIn(500);
		}
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Добавление манги</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма добавления</h2>

		<div class="wrap_left">

			<!-- Форма добавления манги -->
			<form method="POST">
				{!! csrf_field() !!}
				<!-- Русское название -->
				<p><input type="text" name = "russian_name" placeholder = "Русское название" /></p>
				<!-- Английское название -->
				<p><input type="text" name = "english_name" placeholder = "Английское название" /></p>
				<!-- Оригинальное название -->
				<p><input type="text" name = "original_name" placeholder = "Оригинальное название" /></p>
				<!-- Год выпуска -->
				<p><input type="text" name = "year_of_issue" placeholder="Год выпуска"></p>
				<!-- Количество томов -->
				<p><input type="number" name = "volume" placeholder = "Количество томов" /></p>
				<!-- Задний фон -->
				<p>
					<input type="text" class = "half" id = "background" name = "background" placeholder = "Введите URL для заднего фона">
					<input type="button" value = "Посмотреть" onclick = "preview_background()">
				</p>
				<!-- Добавление обложек в текстовому полю -->
				<p>
					<input type="text" class = "half" id = "cover" placeholder = "URL ссылка на изображение тома">
					<input type="button" value = "Добавить" onclick = "add_cover();">
				</p>
				<!-- Обложки томов -->
				<p><textarea style = "height: 100px;" name="images" id="images" placeholder = "Изображения томов" cols="30" rows="10" readonly></textarea></p>
				<p>
					<input type="button" value = "Посмотреть" onclick = "preview_cover()">
					<input type="button" value = "Удалить последнее" onclick = "delete_cover()">
					<input type="button" class = "min" value = "Очистить" onclick = "$('#images').val('')">
				<!-- Описание манги -->
				<p><textarea name="description" cols="30" rows="10" placeholder = "Описание манги"></textarea></p>
				<!-- Категория -->
				<p>
					<select name="category">
						<option selected disabled>Категория произведения</option>
						<option value="Манга">Манга</option>
						<option value="Манхва">Манхва</option>
						<option value="Маньхуа">Маньхуа</option>
					</select>
				</p>
				<!-- Состояние выпуска -->
				<p>
					<select name="release">
						<option selected disabled>Состояние выпуска</option>
						<option value="Выпуск продолжается">Выпуск продолжается</option>
						<option value="Выпуск завершён">Выпуск завершён</option>
						<option value="Выпуск остановлен">Выпуск остановлен</option>
					</select>
				</p>
				<!-- Состояние перевода -->
				<p>
					<select name="translation">
						<option selected disabled>Состояние перевода</option>
						<option value="Продолжается">Продолжается</option>
						<option value="Завершён">Завершён</option>
						<option value="Остановлен">Остановлен</option>
					</select>
				</p>
				<!-- Жанры -->
				<p><input type="text" name = "genres" id = "genres" placeholder="Жанры"></p>
				<p>
					<select id = "genre" class = "half">
						<option selected disabled>Выберите жанр</option>
						@foreach($data->genres as $key => $val)
							<option value="{{ $val->genre }}">{{ $val->genre }}</option>
						@endforeach
					</select>
					<input type="button" value = "Добавить" onclick = "add_genre()">
				</p>
				<!-- Автор -->
				<p><input type="text" name = "author" placeholder="Автор"></p>
				<!-- Переводчик(и) -->
				<p><input type="text" name = "translators" placeholder="Переводчик"></p>
				<!-- Кнопка добавления -->
				<p><input type="button" value = "Добавить" onclick = "ajax_add_manga()"></p>
			</form>

		</div>

		<div class="wrap_right">
			<div class="preview_cover">
				<img src="" alt="">
			</div>
			<div class="touch_cover"></div>
		</div>
	</div>
@endsection