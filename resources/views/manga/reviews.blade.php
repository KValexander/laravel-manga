@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Страница рецензий</h1>
	</div>

	<div class="wrap_content">
		<div class="wrap_left">
			<h2>Последние рецензии</h2>
			<div class="wrap_review">
				@if($data->reviews == 0)
					<p style = "margin: 10px 0 10px 0"><i>Рецензии отсутствую</i></p>
				@else
					@foreach($data->reviews as $key => $val)
						<div class="review">
							Рецензия <a href="/reviews/review/{{ $val->id_review }}">{{ $val->review_title }}</a> на мангу <a href="/manga/{{ $val->id_manga }}">{{ $val->manga_title }}</a>
							<p>{{ $val->date }}| <a href="/user/{{ $val->id_user }}">{{ $val->username }}</a> | Оценка: {{ $val->rating }}/10</p>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
@endsection