@extends("manga.shablon")

@section("title")
	Манга
@endsection

@section("script")
@endsection

@section("content")
	<div class="wrap_content">
		<h1>Страница постов</h1>
	</div>
	<div class="wrap_content">

		<div class="wrap_left">
			<div class="wrap_posts">
				<h2>Новости сайта</h2>
				@if($data->news == 0)
					<h3><i>Посты отсутствуют</i></h3>
				@else
					@foreach($data->news as $key => $val)
						<div class="wrap_post">
							<div class="image_preview">
								@if($val->image_preview == null)
									<img src="https://i.pinimg.com/originals/39/3a/09/393a0950593211c5971031806c75359b.jpg" alt="">
								@else
									<img src="{{ $val->image_preview }}" alt="">
								@endif
							</div>
							<h3><a href="/posts/post/{{ $val->id_post }}">{{ $val->post_title }}</a></h3>
							<p class = "inform">{{ $val->date }} | <a href="/user/{{ $val->id_user }}">{{ $val->username }}</a></p>
							<p>{{ $val->post_announce }} | <a href="/posts/post/{{ $val->id_post }}">Подробнее</a></p>
						</div>
					@endforeach
				@endif
			</div>

			<div class="wrap_posts">
				<h2>Последние посты</h2>
				@if($data->posts == 0)
					<h3><i>Посты отсутствуют</i></h3>
				@else
					@foreach($data->posts as $key => $val)
						<div class="wrap_post">
							<div class="image_preview">
								@if($val->image_preview == null)
									<img src="https://i.pinimg.com/originals/39/3a/09/393a0950593211c5971031806c75359b.jpg" alt="">
								@else
									<img src="{{ $val->image_preview }}" alt="">
								@endif
							</div>
							<h3><a href="/posts/post/{{ $val->id_post }}">{{ $val->post_title }}</a></h3>
							<p class = "inform">{{ $val->date }} | <a href="/user/{{ $val->id_user }}">{{ $val->username }}</a></p>
							<p>{{ $val->post_announce }} | <a href="/posts/post/{{ $val->id_post }}">Подробнее</a></p>
						</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="wrap_right">
			@if($access != 0)
				<div class="posts_panel">
					<h4>Действия</h4>
					<p><a href="/posts/add">Добавить пост</a></p>
				</div>
			@endif
			<div class="posts_panel">
				<h4>Все теги</h4>
				@foreach($data->tags as $key => $val)
					<p><a>{{ $val->tag }}</a></p>
				@endforeach
			</div>
		</div>

	</div>
@endsection