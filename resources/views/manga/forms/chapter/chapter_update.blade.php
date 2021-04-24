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
		function ajax_update_chapter() {
			$.ajax({
				url: "/manga/{{$data->manga->id_manga}}/update/chapter",
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
		<h2 style = "margin: 0">Изменение главы <a href="/manga/{{ $data->manga->id_manga }}/chapter/{{ $data->chapter->volume }}/{{ $data->chapter->chapter }}">{{ $data->chapter->volume }} - {{ $data->chapter->chapter }} {{ $data->chapter->chapter_title }}</a> для манги <a href="/manga/{{ $data->manga->id_manga }}">{{ $data->manga->russian_name }}</a></h2>
	</div>
	<div class="wrap_content">
		<h2>Форма обновления</h2>
		<form method="POST">
			<p>
				<input type="text" class = "min" name = "volume" placeholder = "Том" value = "{{ $data->chapter->volume }}">
				<input type="text" class = "min" name = "chapter" placeholder = "Глава" value = "{{ $data->chapter->chapter }}">
				<input type="text" class = "half" name = "chapter_title" placeholder = "Название" value = '{{ $data->chapter->chapter_title }}'></p>
			<p>
				<input type="text" class = "half" id = "page" placeholder = "Введите URL страницы">
				<input type="button" value = "Добавить страницу" onclick = "add_page()">
			</p>
			<p><textarea name="images" id = "images" class = "images" cols="30" rows="10" placeholder = "URL ссылки на страницы манги">{{ $data->chapter->images }}</textarea> </p>
			
			<p><input type="button" value = "Обновить главу" onclick = "ajax_update_chapter()"></p>
		</form>
	</div>
@endsection