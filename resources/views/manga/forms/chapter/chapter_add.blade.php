@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		$(function() {
			@if(!empty($data->manga->background))
	 			background_image('{{$data->manga->background}}');
	 		@endif
		});
		function ajax_add_chapter() {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/add/chapter",
				type: "POST",
				header: {
					"Content-Type": "application/json"
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

		function add_page() {
			var page = $("#page").val();
			if(page == "") return;
			if($("#images").text().length == 0) out = page;
			else out = "," + page;
			$("#images").append(out);
			$("#page").val("");
		}
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Добавление глав для манги {{ $data->manga->russian_name }}</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма добавления</h2>
		<form method="POST">
			<p><input type="text" class = "min" name = "volume" placeholder = "Том"> <input type="text" class = "min" name = "chapter" placeholder = "Глава"> <input type="text" class = "half" name = "chapter_title" placeholder = "Название"></p>
			<p>
				<input type="text" class = "half" id = "page" placeholder = "Введите URL страницы">
				<input type="button" value = "Добавить страницу" onclick = "add_page()">
			</p>
			<p><textarea name="images" id = "images" cols="30" rows="10" placeholder = "URL ссылки на страницы манги"></textarea> </p>
			
			<p><input type="button" value = "Добавить главу" onclick = "ajax_add_chapter()"></p>
		</form>
	</div>
	<div class="wrap_content">
		<h2>Все главы</h2>
		<div class="chapters_content">
		@foreach($data->chapters as $key => $val)
			<div class="chapter">
				<p style = "float: left; width: 80%"><a href="/manga/{{ $data->manga->id_manga }}/chapter/{{ $val->volume }}/{{ $val->chapter }}">{{$data->manga->russian_name}} {{ $val->volume }} - {{ $val->chapter }} {{ $val->chapter_title }} </a></p>
				<p style = "float: left; width: 10%"><a href="/manga/{{ $data->manga->id_manga }}/update/chapter?volume={{ $val->volume }}&chapter={{ $val->chapter }}">Изменить</a></p>
				<p><a href="/manga/{{ $data->manga->id_manga }}/delete/{{ $val->volume }}/{{ $val->chapter }}">Удалить</a></p>
			</div>
		@endforeach
		</div>
	</div>
@endsection