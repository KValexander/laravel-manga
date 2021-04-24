@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Страница модерации</h1>
	</div>
	<div class="wrap_content">
		<h2>Все пользователи</h2>
		<h4 style = "float: left; width: 88.1%">Имя пользователя</h4>
		<h4>Действие</h4>
		<div class="wrap_list_manga">
			@if(empty($data->users))
				<h3>Информация отсутствует</h3>
			@else
				@foreach($data->users as $key => $val)
				<div class="list_manga">
					<p style = "float: left; width: 88%"><a href="/user/{{ $val->id }}">{{ $val->username }}</a></p>
					<p> <a href="">Дать бан</a></p>
				</div>
				@endforeach
			@endif
		</div>
	</div>
@endsection