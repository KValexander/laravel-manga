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

		// AJAX запрос на отправление сообщения
		// ============================
		function ajax_send_message() {
			if($("#message").val() == "") return;
			var message = {
				"id_dialog": "{{ $data->dialog->id_dialog }}",
				"id_sender": "{{ $data->user_first->id }}",
				"id_addressee": "{{ $data->user_second->id }}",
				"message": $("#message").val(),
			};
			$.ajax({
				url: "/personal_area/message/dialog",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: message,
				success: function(data) {
					$("#message").val("");
					document.location.href = '';
					return;
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
					return;
				}
			});
		}

		function ajax_delete_message(id_message) {
			var delete_message = {
				"id_message": id_message
			};
			$.ajax({
				url: "/personal_area/message/dialog/del",
				type: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: delete_message,
				success: function(data) {
					document.location.href = '';
					return;
				},
				error: function(jqXHR) {
					call_message(jqXHR.responseText);
					return;
				}
			});
		}

		// Вывод написанного сообщения
		// ==========================
		function message_prepend() {
			out = `
				<div class="message">
					<p><b><a href="/user/{{ $data->user_first->id }}">{{ $data->user_first->username }}</a></b></p>
					<p class = "text">${ $("#message").val() }</p>
				</div>
			`;
			$("div.dialog").prepend(out);
		}
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h2 style = "margin: 0"> <a href="/user/{{ $data->user_first->id }}">{{ $data->user_first->username }}</a> - <a href="/user/{{ $data->user_second->id }}">{{$data->user_second->username}}</a></h2>
	</div>
	<div class="wrap_content">
		<div class="wrap_left">
			<form onsubmit="ajax_send_message()" method = "POST">
			<p>
				<input type="text" id = "message" style = "width: 690px;" placeholder = "Введите сообщение">
				<input type="button" class = "min" value = "Отправить" onclick = "ajax_send_message()">
			</p>
			</form>
			<div class="dialog">
				@if(count($data->messages) == 0)
					<p>Сообщения отсутствуют</p>
				@else
					@foreach($data->messages as $key => $val)
					<div class="message">
						<p><b><a href="/user/{{ $val->id_sender }}">{{ $val->username }}</a></b>
							@if($username == $val->username)
								<span style = "font-size: 12pt"> | <a onclick = "ajax_delete_message('{{ $val->id_message }}')">Удалить</a></span>
							@endif
						</p>
						<p class = "text">{{ $val->message }}</p>
					</div>
					@endforeach
				@endif
			</div>
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