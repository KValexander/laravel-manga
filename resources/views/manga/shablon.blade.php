<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield("title")</title>
	<link rel="stylesheet" href="{{ asset('manga/css/style.css') }}">

	<script src = "{{ asset('manga/script/jquery-3.5.1.min.js') }}"></script>
	<script src = "{{ asset('manga/script/jquery.cookie.js') }}"></script>

	<script src = "{{ asset('manga/script/main.js') }}"></script>

	<link rel="shortcut icon" href="{{ asset('manga/favicon.png') }}">

	@yield("script")
</head>
<body>
	
	<header>
		<div class="content">
			<nav>
				<a href="/">Главная страница</a> |
				<a href="/posts">Посты</a> |
				<a href="/reviews">Рецензии</a> ||
				<!-- <a href="/collections">Коллекции</a> || -->
				@if($access == "1" || $access == "2")
					<a href="/add/manga">Добавить мангу</a> |
					<a href="/directory">Страница справочников</a> ||
				@endif
				@if($access == "0")
					<a href="/login">Авторизация</a> |
					<a href="/register">Регистрация</a>
				@else
					<a href="/personal_area/bookmarks">Закладки</a> |
					<a href="/personal_area">{{$username}}</a> ||
					<a href="/logout">Выйти</a>
				@endif
			</nav>
		</div>
	</header>

	<main>
		<div class="content">

			@yield("content")
		</div>
	</main>

	<footer>
		<div class="content"></div>
	</footer>

	<div id="message"></div>
	<div id="image"></div>
	<div id="mask"></div>
</body>
</html>