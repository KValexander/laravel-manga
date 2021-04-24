@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
		// Функция добавления тега
		// ==================
		function add_tag() {
			var tag = $("#tag").val();
			if(tag == null) return;
			if ($("#tags").val() == "") out = tag;
			else out = ", " + tag;
			document.querySelector("#tags").value += out;
		}

		// Функция предпросмотра поста
		// =======================
		function post_preview() {
			var content = $("#content").val();
			var regexp = /[\r\n]+/;

			var arr = content.split(regexp);
			for(var i = 0; i < arr.length; i++) {
				var content = content.replace(regexp, "<p>");
			}

			out = `
			<div class="wrap_content"><h2 style = "margin: 0">Предпросмотр</h2></div>
			<div class="wrap_content">
				<div class="wrap_left">
					<div class="post">
						<h3>${ $("#title").val() }</h3>
						<div class="post_content">
							<p>${ content }</p>
						</div>
						<p><b>Метки</b>: ${ $("#tags").val() }</p>
					</div>
				</div>

				<div class="wrap_right">
					<div class="user_avatar">
						@if(empty($data->user->avatar))
							<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">
						@else
							<img src="{{ $data->user->avatar }}" alt="">
						@endif
					</div>
					<div class="user_panel">
						<b><p><a href="/user/{{ $data->user->id }}">{{ $data->user->username }}</a></p></b>
						<p><a>Добавить в друзья</a></p>
						<p><a>Написать сообщение</a></p>
					</div>
				</div>
			</div>
			`;

			$("#preview").html(out);

		}

		// AJAX запрос на добавление поста
		// =======================
		function ajax_post_update() {
			$.ajax({
				url: "/posts/post/ {{ $data->post->id_post }} /update",
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
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1 class = "not">Страница обновления поста</h1>
	</div>
	<div class="wrap_content">
		<h2>Форма обновления</h2>
		<div class="wrap_left">
				<form method = "POST">
					{!! csrf_field() !!}
					<p><input type="text" name = "post_title" id = "title" value = "{{ $data->post->post_title }}" placeholder = "Заголовок поста"></p>
					<p>
						<input type="text" name = "image_preview" value = "{{ $data->post->image_preview }}" placeholder = "URL превью поста (необязательно)">
					</p>
					<p><textarea style = "height: 300px;" id = "content" name="post_content" cols="30" rows="10" placeholder = "Содержание поста">{{ $data->post->post_content }}</textarea></p>
					<p><input type="text" name = "tags" value = "{{ $data->post->tags }}" id = "tags" placeholder = "Теги"></p>
					<p>
						<select id="tag" class = "half">
							<option selected disabled>Выберите тег</option>
							@foreach($data->tags as $key => $val)
								<option value="{{ $val->tag }}">{{ $val->tag }}</option>
							@endforeach
						</select>
						<input type="button" value = "Добавить" onclick = "add_tag()">
					</p>
					<p>
						<input type="button" value = "Обновить пост" onclick = "ajax_post_update()">
						<input type="button" value = "Предпросмотр поста" onclick = "post_preview()">
					</p>
				</form>
		</div>
		<div class="wrap_right">
			<div class="user_avatar">
				@if(empty($data->user->avatar))
					<img src="{{ asset('manga/images/hollow_star.png') }}" alt="">
				@else
					<img src="{{ $data->user->avatar }}" alt="">
				@endif
			</div>
			<div class="user_panel">
				<p style = "cursor: default"><b>{{ $data->user->username }}</b></p>
				<p><a href="/personal_area">Личный кабинет</a></p>
			</div>
		</div>
	</div>

	<div id="preview"></div>
	
@endsection