@extends("manga.shablon")

@section("title")
	Манга
@endsection
@section("content")
	<!-- <div class="wrap_content"><h1>Ошибка</h1></div> -->
	<div class="wrap_content"><div class = "error"><h2>{{ $data->message }}</h2></div></div>
@endsection