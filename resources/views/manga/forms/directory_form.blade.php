@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>

		function ajax_directory_add(value, type) {
			$.ajax({
				url: "/directory/add?" + type + "=" + value,
				type: "GET",
				success: function(data){
					document.querySelector("#genre_add").value = "";
					document.querySelector("#tag_add").value = "";
					call_message(data.message);
					select_update_genres(data.genres);
					select_update_tags(data.tags);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		function ajax_directory_delete(value, type) {
			$.ajax({
				url: "/directory/delete?" + type + "=" + value,
				type: "GET",
				success: function(data){
					call_message(data.message);
					select_update_genres(data.genres);
					select_update_tags(data.tags);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		function select_update_genres(data) {
			out = "<option selected disabled>Выберите жанр</option>";
			for(var i = 0; i < data.length; i++) {
				out += `
					<option value = "${data[i].id_genre}">${data[i].genre}</option>
				`;
			}
			$("#genre_delete").html(out);
		}

		function select_update_tags(data) {
			out = "<option selected disabled>Выберите тег</option>";
			for(var i = 0; i < data.length; i++) {
				out += `
					<option value = "${data[i].id_tag}">${data[i].tag}</option>
				`;
			}
			$("#tag_delete").html(out);
		}

	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Страница справочников</h1>
	</div>
	<div class="wrap_content">
		<h2>Справочник жанров</h2>

		<form onsubmit = "ajax_directory_add($('#genre_add').val(), 'genre')">
			<p>
				<input type="text" class = "half" id = "genre_add" placeholder = "Введите жанр" />
				<input type="button" value = "Добавить" onclick = "ajax_directory_add($('#genre_add').val(), 'genre')">
			</p>

			<p>
				<select class = "half" id = "genre_delete">
					<option selected disabled>Выберите жанр</option>
					@foreach($data->genres as $key => $val)
						<option value="{{ $val->id_genre }}">{{ $val->genre }}</option>
					@endforeach
				</select>
				<input type="button" value = "Удалить" onclick = "ajax_directory_delete($('#genre_delete').val(), 'id_genre')">
			</p>
		</form>

		<br>

		<h2>Справочник тегов</h2>

		<form onsubmit = "ajax_directory_add($('#tag_add').val(), 'tag')">
			<p>
				<input type="text" class = "half" id = "tag_add" placeholder = "Введите тег" />
				<input type="button" value = "Добавить" onclick = "ajax_directory_add($('#tag_add').val(), 'tag')">
			</p>

			<p>
				<select class = "half" id = "tag_delete">
					<option selected disabled>Выберите тег</option>
					@foreach($data->tags as $key => $val)
						<option value="{{ $val->id_tag }}">{{ $val->tag }}</option>
					@endforeach
				</select>
				<input type="button" value = "Удалить" onclick = "ajax_directory_delete($('#tag_delete').val(), 'id_tag')">
			</p>
		</form>
	</div>
@endsection