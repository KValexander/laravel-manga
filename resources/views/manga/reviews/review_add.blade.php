@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>

		$(function() {
			// Переменные для возможности работы с адресной строкой
			var params = document.location.search;
			var search = new URLSearchParams(params);

			// Предварительная работа с адресной строкой
			if(search.has("id_manga")) {
		 		var id_manga = search.get("id_manga");
		 		pushState(id_manga);
		 		ajax_rating(id_manga);
				var manga = document.querySelector("#manga").getElementsByTagName("option");
				for(var i = 0; i < manga.length; i++) {
					if(manga[i].value == id_manga) manga[i].selected = true;
				}
			}

			document.querySelector("#manga").addEventListener('change', function (event) {
		 		pushState(event.target.value);
		 		ajax_rating(event.target.value);
			});

		});

		// Работа с адресной строкой с помощью History API
		// =======================
		function pushState(num) {
			if(window.history.state == null) {
				window.history.pushState({id_manga: num}, '', '?id_manga=' + num);
			} else {
				window.history.replaceState({id_manga: num}, '', '?id_manga=' + num);
			}
			return window.history.state.id_manga;
		}

		// AJAX запрос на получение оценки пользователем манги
		// ============================
		function ajax_rating(id_manga){
			$.ajax({
				url: "/review/add/rating?id_manga=" + id_manga,
				type: "GET",
				success: function(data) {
					rating_out(data.rating);
					console.log(data.rating);
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
				}
			});
		}

		// Вывод количества звёзд оценки пользователем манги
		// ===========================
		function rating_out(rating) {
			for (var i = 0; i < rating; i++) {
				$("#rating"+i).removeClass("hollow_rating");
				$("#rating"+i).addClass("full_rating");
			}
		}

		// AJAX запрос на добавление рецензии
		// =========================
		function ajax_add_review() {
			var params = document.location.search;
			var search = new URLSearchParams(params);
			if(!search.has("id_manga")) {
		 		call_message("Манга не была выбрана");
		 		return;
			}
			var id_manga = search.get("id_manga");
			var data = {
				"id_manga": id_manga,
				"review_title": $("#title").val(),
				"review_content": $("#content").val(),
			};
			$.ajax({
				url: "/review/add",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: data,
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
		<h1>Страница написании рецензии</h1>
	</div>

	<div class="wrap_content">
		<div class="wrap_left">
			<h2>Форма написания</h2>
			<form onsubmit = "ajax_add_review()">
				<p>
					<select name = "id_manga" id = "manga">
						<option selected disabled>Выбрать мангу для рецензии</option>
						@foreach($data->manga as $key => $val)
							<option value="{{ $val->id_manga }}">{{ $val->russian_name }}</option>
						@endforeach
					</select>
				</p>
				<h3 style = "margin-bottom: 0">Ваша оценка:</h3>
				<div style = "height: 40px;" class="ratings">
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating0"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating1"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating2"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating3"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating4"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating5"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating6"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating7"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating8"></div>
					<div style = "width: 30px; height: 30px;" class = "hollow_rating count" id = "rating9"></div>
				</div>
				<p><input type="text" name = "review_title" id = "title" placeholder = "Заголовок для рецензии"></p>
				<p><textarea style = "height: 300px;" name="review_content" id = "content" placeholder = "Содержание рецензии" id="" cols="30" rows="10"></textarea></p>
				<p><input type="button" value = "Добавить рецензию" onclick = "ajax_add_review()"></p>
			</form>
		</div>
		<div class="wrap_right">
			<!-- <div class="review_panel"> -->
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
			<!-- </div> -->
		</div>
	</div>
@endsection