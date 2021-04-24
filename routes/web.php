<?php

use Illuminate\Support\Facades\Route;

use App\Models\UsersModel;

// Проверка на авторизацию
// Передача переменной access для всех представлений в группе маршрутов
Route::group(["middleware" => "session"], function() {
	
	// Главная страница
	Route::get('/', 'MainController@main_page')->name("main_page");

	// Страница постов
	Route::get('/posts', 'PostsController@posts');

	// Страница рецензий
	Route::get('/reviews', 'ReviewController@reviews');

	// Страница манги
	Route::get('/manga/{id}', 'MangaController@manga');
	// Добавление рейтинга
	Route::get('/manga/{id}/rating', 'RatingController@rating');

	// Страница одного поста
	Route::get('/posts/post/{id_post}', 'PostsController@post');

	// Страница рецензии
	Route::get('/reviews/review/{id_review}', 'ReviewController@review_single');

	// Страница главы
	Route::get('/manga/{id}/chapter/{volume}/{chapter}', 'ChapterController@chapter');

	// Регистрация
	Route::get('/register', 'AuthController@register_form');
	Route::post('/register', 'AuthController@register');

	// Аутентификация
	Route::get('/login', 'AuthController@login_form');
	Route::post('/login', 'AuthController@login');


	// Группа, в которую не может войти неавторизованный пользователь
	Route::group(["middleware" => "user"], function() {

		// Добавление поста
		Route::get('/posts/add', 'PostsController@post_add_form');
		Route::post('/posts/add', 'PostsController@post_add');
		// Удаление поста
		Route::get('/posts/post/{id_post}/delete', 'PostsController@post_delete');
		// Изменение поста
		Route::get('/posts/post/{id_post}/update', 'PostsController@post_update_form');
		Route::post('/posts/post/{id_post}/update', 'PostsController@post_update');
		// Добавление комментария к посту
		Route::get('/posts/post/{id_post}/comment', 'CommentController@comment_post');
		// Удаление комментария к посту
		Route::get('/posts/post/{id_post}/comment', 'CommentController@comment_post');

		// Добавление рецензии
		Route::get('/review/add', 'ReviewController@review_add_form');
		Route::post('/review/add', 'ReviewController@review_add');
		// Получение оценки пользователя на мангу
		Route::get('/review/add/rating', 'ReviewController@review_getting_rating');
		// Удаление рецензии
		Route::get('/review/delete', 'ReviewController@review_delete');
		// Изменение рецензии
		Route::get('/review/update', 'ReviewController@review_update_form');
		Route::post('/review/update', 'ReviewController@review_update');

		// Личный кабинет
		Route::get('/personal_area', 'UserController@personal_area');
		// Страница закладок
		Route::get('/personal_area/bookmarks', 'UserController@bookmarks');
		// Страница друзей
		Route::get('/personal_area/friend', 'UserController@friend');
		// Страница постов
		Route::get('/personal_area/post', 'UserController@post');
		// Страница рецензий
		Route::get('/personal_area/review', 'UserController@review');
		// Публичная страница пользователя
		Route::get('/user/{id_user}', 'UserController@user');

		// Страница сообщение
		Route::get('/personal_area/message', 'MessageController@message');
		// Страница диалога
		Route::get('/personal_area/message/dialog', 'MessageController@dialog');
		// Отправка и удаление сообщения
		Route::post('/personal_area/message/dialog', 'MessageController@message_send');
		// Удаление сообщения
		Route::post('/personal_area/message/dialog/del', 'MessageController@message_delete');

		// Добавление и удаление друзей
		Route::get('/user/{id_user}/friend', 'FriendController@friend');

		// Настройки личного кабинета
		Route::get('/personal_area/preference', 'UserPreferenceController@preference_form');
		Route::post('/personal_area/preference', 'UserPreferenceController@preference');

		// Удаление пользователя
		Route::get('/personal_area/delete', 'UserPreferenceController@preference_delete');

		// Добавление комментария к манге
		Route::get('/manga/{id}/add/comment', 'CommentController@comment_manga_add');
		// Удаление комментария к манге
		Route::get('/manga/{id}/delete/comment', 'CommentController@comment_manga_delete');

		// Добавление, обновление и удаление закладок
		Route::get('/manga/{id}/add/bookmarks', 'BookmarksController@bookmarks_add');
		Route::get('/manga/{id}/update/bookmarks', 'BookmarksController@bookmarks_update');
		Route::get('/manga/{id}/delete/bookmarks', 'BookmarksController@bookmarks_delete');
		// Специальный запрос для закладки типа watching
		Route::get('/manga/{id}/update/bookmarks/watching', 'BookmarksController@bookmarks_watching');

		// Особые права доступа для редакторов и выше
		Route::group(["middleware" => "editor"], function() {

			// Обновление информации о манге
			Route::get('/manga/{id}/update', 'UpdateController@manga_update_form');
			Route::post('/manga/{id}/update', 'UpdateController@manga_update');

			// Добавление глав для манги
			Route::get('/manga/{id}/add/chapter', 'ChapterAddController@chapter_add_form');
			Route::post('/manga/{id}/add/chapter', 'ChapterAddController@chapter_add');

			// Изменение глав для манги
			Route::get('/manga/{id}/update/chapter', 'ChapterUpdateController@chapter_update_form');
			Route::post('/manga/{id}/update/chapter', 'ChapterUpdateController@chapter_update');

			// Страница справочников
			Route::get('/directory', 'DirectoryController@directory_form');

			// Добавление записей в справочники
			Route::get('/directory/add', 'DirectoryController@directory_add');

			// Добавление манги
			Route::get('/add/manga', 'MangaAddController@manga_add_form');
			Route::post('/add/manga', 'MangaAddController@manga_add');

			// Удаление манги
			Route::get('/manga/{id}/delete', 'DeleteController@manga_delete');

			// Удаление записей из справочников
			Route::get('/directory/delete', 'DirectoryController@directory_delete');

			// Удаление главы манги
			Route::get('/manga/{id}/delete/{volume}/{chapter}', 'DeleteController@chapter_delete');

			// Максимально особые права доступа, модератор и выше
			Route::group(["middleware" => "access"], function() {

				// Страница модерации
				Route::get('/moderation', 'ModerationController@moderation');


			});
			
		});

		// Сообщение об ошибке в случае отказа прав доступа
		Route::get("/message", function() {
			$message = "Ошибка доступа";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		})->name("message");

		// Выход из аккаунта
		Route::get('/logout', function() {
			if(Auth::check()) {
				$user = UsersModel::find(Auth::id());
				$user->online = 0;
				$user->save();
				Auth::logout();
				return redirect()->route("main_page");
			} else {
				$message = "Вы не авторизованы";
				$data = (object)["message" => $message];
				return view("manga.errors.error", ["data" => $data]);
			}
		});
	});

	// Сообщение об ошибке в случае неавторизации
	Route::get("/error", function() {
		$message = "Вы не авторизованы";
		$data = (object)["message" => $message];
		return view("manga.errors.error", ["data" => $data]);
	})->name("error");

});


