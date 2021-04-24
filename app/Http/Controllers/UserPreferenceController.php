<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\PostModel;
use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\FriendModel;
use App\Models\RatingModel;
use App\Models\ReviewModel;
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;

class UserPreferenceController extends Controller {

	// Страница пользовательских настроек
	// ==============================================
	public function preference_form(Request $request) {
		if(!Auth::check()) {
			$message = "Вы не авторизованы";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = Auth::user();
		$data = (object)[
			"user" => $user
		];

		return view("manga.private.preference", ["data" => $data]);
	}

	public function preference(Request $request) {
		if(!Auth::check()) {
			$message = "Вы не авторизованы";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}
		
		$auth_user = Auth::user();

		// Запрос на изменение аватарки
		if($request->has("avatar")) {
			$validator = Validator::make($request->all(), [
				// "avatar" => "required|string|regex:/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/",
			]);
			if($validator->fails()) {
				$errors = $validator->errors();
				$data = (object)["message" => $errors];
				return response(json_encode($data), 422)
					->header("Content-Type", "application/json");
			}

			$user = UsersModel::find($auth_user->id);
			$user->avatar = $request->input("avatar");
			$user->save();

			$message = "Изображение изменено";
			$data = (object)[
				"message" => $message,
				"avatar" => $user->avatar
			];

			return response(json_encode($data), 200)
				->header("Content-Type", "application/json");
		}

		// Запрос на изменение пароля
		if($request->has("password")) {
			$message = "На данный момент недоступно";
			$data = (object)["message" => $message];
			return response(json_encode($data), 200)
				->header("Content-Type", "application/json");
		}

		// Запрос на изменение основных настроек
		if($request->has("username")) {
			$validator = Validator::make($request->all(), [
				"username" => "required|string|max:30|min:4"
			]);
			
			if($validator->fails()) {
				$errors = $validator->errors();
				$data = (object)["message" => $errors];
				return response(json_encode($data), 422)
					->header("Content-Type", "application/json");
			}

			$user = UsersModel::find($auth_user->id);
			$user->username = $request->input("username");
			$user->status = $request->input("status");
			$user->about = $request->input("about");
			$user->background = $request->input("background");
			$user->save();

			$message = "Информация обновлена";
			$data = (object)["message" => $message];
			return response(json_encode($data), 200)
				->header("Content-Type", "application/json");
		}
	}

	public function preference_delete(Request $request) {
		$user = Auth::user();

		if(empty($user)) {
			$message = "Такого пользователя не существует";
			$data = ["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}


		$ratings = RatingModel::where("id_user", $user->id)->get();
		if(!empty($ratings)) {
			for ($i=0; $i < count($ratings); $i++) { 
				$rating = RatingModel::find($ratings[$i]->id_rating);
				$rating->delete();
			}
		}
		
		$bookmarks = BookmarksModel::where("id_user", $user->id)->get();
		if(!empty($bookmarks)) {
			for ($i=0; $i < count($bookmarks); $i++) { 
				$bookmark = BookmarksModel::find($bookmarks[$i]->id_bookmarks);
				$bookmark->delete();
			}
		}
		
		$posts = PostModel::where("id_user", $user->id)->get();
		if(!empty($posts)) {
			for ($i=0; $i < count($posts); $i++) { 
				$post = PostModel::find($posts[$i]->id_post);
				$post->delete();
			}
		}
		
		$reviews = ReviewModel::where("id_user", $user->id)->get();
		if(!empty($reviews)) {
			for ($i=0; $i < count($reviews); $i++) { 
				$review = ReviewModel::find($reviews[$i]->id_review);
				$review->delete();
			}
		}
		
		$friends = FriendModel::where("id_first", $user->id)->get();
		if(!empty($friends)) {
			for ($i=0; $i < count($friends); $i++) { 
				$friend = FriendModel::find($friends[$i]->id_friend);
				$friend->delete();
			}
		}
		
		$friends = FriendModel::where("id_second", $user->id)->get();
		if(!empty($friends)) {
			for ($i=0; $i < count($friends); $i++) { 
				$friend = FriendModel::find($friends[$i]->id_friend);
				$friend->delete();
			}
		}

		$comments = CommentModel::where("id_user", $user->id)->get();
		if(!empty($comments)) {
			for ($i=0; $i < count($comments); $i++) { 
				$comment = CommentModel::find($comments[$i]->id_comment);
				$comment->delete();
			}
		}

		$user = UsersModel::find($user->id);
		$user->delete();

		$message = "Пользователь был удалён";
		$data = (object)["message" => $message];
		return view("manga.errors.error", ["data" => $data]);

	}

}
