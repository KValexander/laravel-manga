@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
	<script>
	</script>
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Главная страница</h1>
		@if($access == "1" || $access == "2")
			<a href="/moderation">Страница модерации</a>
		@endif
	</div>
	<div class="wrap_content">
		<h2>Последние добавления</h2>
		<h4 style = "float: left; width: 86%">Название</h4>
		<h4>Дата создания</h4>
		<div class="wrap_list_manga">
			@if(empty($data->manga))
				<h3>Информация отсутствует</h3>
			@else
				@foreach($data->manga as $key => $val)
				<div class="list_manga">
					<p style = "float: left; width: 88%"><a href="/manga/{{ $val->id_manga }}">{{ $val->russian_name }}</a> | <span onmouseenter="call_image('{{ $val->image }}')">Об</span></p>
					<p>{{ $val->date }}</p>
				</div>
				@endforeach
			@endif
		</div>
	</div>
@endsection