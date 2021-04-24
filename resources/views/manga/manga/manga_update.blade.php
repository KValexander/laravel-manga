@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
	 	var k = 1;

	 	$(function() {
			// Скрипт для выбора типа новеллы по умолчанию
			var category = document.querySelector("#category").getElementsByTagName("option");
			for(var i = 0; i < category.length; i++) { if (category[i].value == "{{$data->manga->category}}") category[i].selected = true; }
			// Скрипт для выбора типа новеллы по умолчанию
			var release = document.querySelector("#release").getElementsByTagName("option");
			for(var i = 0; i < release.length; i++) { if (release[i].value == "{{$data->manga->release}}") release[i].selected = true; }
			// Скрипт для выбора типа новеллы по умолчанию
			var translation = document.querySelector("#translation").getElementsByTagName("option");
			for(var i = 0; i < translation.length; i++) { if (translation[i].value == "{{$data->manga->translation}}") translation[i].selected = true; }

	 		@if(!empty($data->manga->background))
	 			background_image('{{$data->manga->background}}');
	 		@endif
	 	});

		function add_genre() {
			var choice = $("#genre").val();
			if($("#genres").val() == "") out = choice;
			else out = ", " + choice;
			document.querySelector("#genres").value += out;
		}

		function add_cover() {
			var cover = $("#cover").val();
			if(cover == "") return;
			if($("#images").text().length == 0) out = cover;
			else out = "," + cover;
			$("#images").append(out);
			$("#cover").val("");
		}
		
		function ajax_update_manga() {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/update",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: $("form").serialize(),
				success: function(data) {
					call_message(data.message);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		function preview_background() {
			var url = $("#background").val();
			background_image(url);
		}

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
		<h1>Обновление информации</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма обновления</h2>

		<div class="wrap_left">

			<!-- Форма добавления манги -->
			<form method="POST">
				{!! csrf_field() !!}
				<!-- Русское название -->
				<p><input type="text" name = "russian_name" placeholder = "Русское название" value = "{{$data->manga->russian_name}}" /></p>
				<!-- Английское название -->
				<p><input type="text" name = "english_name" placeholder = "Английское название" value = "{{$data->manga->english_name}}" /></p>
				<!-- Оригинальное название -->
				<p><input type="text" name = "original_name" placeholder = "Оригинальное название" value = "{{$data->manga->original_name}}" /></p>
				<!-- Год выпуска -->
				<p><input type="text" name = "year_of_issue" placeholder="Год выпуска" value = "{{$data->manga->year_of_issue}}" /></p>
				<!-- Количество томов -->
				<p><input type="number" name = "volume" placeholder = "Количество томов" value = "{{$data->manga->volume}}" /></p>
				<!-- Задний фон -->
				<p>
					<input type="text" class = "half" id = "background" name = "background" value = "{{ $data->manga->background }}" placeholder = "Введите URL для заднего фона">
					<input type="button" value = "Посмотреть" onclick = "preview_background()">
				</p>
				<!-- Обложки томов -->
				<p>
					<input type="text" class = "half" id = "cover" placeholder = "Введите URL обложки">
					<input type="button" value = "Добавить обложку" onclick = "add_cover()">
				</p>
				<p><textarea style = "height: 100px;" name="images" id="images" placeholder = "Изображения томов (URL ссылки, через запятую)" cols="30" rows="10">{{$data->manga->images}}</textarea></p>
				<p><input type="button" value = "Посмотреть" onclick = "preview_cover()"></p>
				<!-- Описание манги -->
				<p><textarea name="description" cols="30" rows="10" placeholder = "Описание манги">{{$data->manga->description}}</textarea></p>
				<!-- Категория -->
				<p>
					<select name="category" id = "category">
						<option selected disabled>Категория произведения</option>
						<option value="Манга">Манга</option>
						<option value="Манхва">Манхва</option>
						<option value="Маньхуа">Маньхуа</option>
					</select>
				</p>
				<!-- Состояние выпуска -->
				<p>
					<select name="release" id = "release">
						<option selected disabled>Состояние выпуска</option>
						<option value="Выпуск продолжается">Выпуск продолжается</option>
						<option value="Выпуск завершён">Выпуск завершён</option>
						<option value="Выпуск остановлен">Выпуск остановлен</option>
					</select>
				</p>
				<!-- Состояние перевода -->
				<p>
					<select name="translation" id = "translation">
						<option selected disabled>Состояние перевода</option>
						<option value="Продолжается">Продолжается</option>
						<option value="Завершён">Завершён</option>
						<option value="Остановлен">Остановлен</option>
					</select>
				</p>
				<!-- Жанры -->
				<p><input type="text" name = "genres" id = "genres" placeholder="Жанры" value = "{{$data->manga->genres}}"></p>
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
				<p><input type="text" name = "author" placeholder="Автор" value = "{{$data->manga->author}}"></p>
				<!-- Переводчик(и) -->
				<p><input type="text" name = "translators" placeholder="Переводчик" value = "{{$data->manga->translators}}"></p>
				<!-- Кнопка сохранения -->
				<p><input type="button" value = "Сохранить" onclick = "ajax_update_manga()"></p>
			</form>

		</div>

		<div class="wrap_right">
			<div class="preview_cover">
				<img src="https://nyapi.ru/thumb/2/mK03Pytn5J0nYTfBuTGYsw/r/d/589-3-18.jpg" alt="">
			</div>
			<div class="touch_cover"></div>
		</div>
	</div>
@endsection