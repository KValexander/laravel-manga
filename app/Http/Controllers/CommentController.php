<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\PostModel;
use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\RatingModel;
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;

class CommentController extends Controller {

	public function comment_manga_add(Request $request) {
		$id = $request->route("id");

		$validator = Validator::make($request->all(), [
			"comment" => "required|string",
		]);
		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		$comment = new CommentModel;
		$comment->id_manga = $request->route("id");
		$comment->id_user = Auth::id();
		$comment->comment = $request->input("comment");
		$comment->type = "manga";
		$comment->save();

		$message = "Комментарий добавлен";

		$pre_comments = CommentModel::where("id_manga", $id)->orderBy("id_comment", "ASC")->get();
		for ($i=0; $i < count($pre_comments); $i++) {
			$date = explode(" ", $pre_comments[$i]->created_at);
			$users[] = UsersModel::where("id", $pre_comments[$i]->id_user)->first();
			$comments[] = (object)[
				"id_comment" => $pre_comments[$i]->id_comment,
				"id_user" => $users[$i]->id,
				"username" => $users[$i]->username,
				"avatar" => $users[$i]->avatar,
				"comment" => $pre_comments[$i]->comment,
				"reply" => $pre_comments[$i]->reply,
				"date" => $date[0],
			];
		}

		$data = (object)[
			"message" => $message,
			"comments" => $comments
		];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function comment_manga_delete(Request $request) {
		$id = $request->route("id");

		$comment = CommentModel::find($request->input("id_comment"));
		if(empty($comment)) {
			$message = "Такого комментария не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		if ($comment->id_user != Auth::id()) {
			$message = "Этот комментарий не ваш";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		} else {
			$comment->delete();
			$message = "Комментарий удалён";
		}

		$pre_comments = CommentModel::where("id_manga", $id)->orderBy("id_comment", "ASC")->get();
		$comments = array();
		for ($i=0; $i < count($pre_comments); $i++) {
			$date = explode(" ", $pre_comments[$i]->created_at);
			$users[] = UsersModel::where("id", $pre_comments[$i]->id_user)->first();
			$comments[] = (object)[
				"id_comment" => $pre_comments[$i]->id_comment,
				"id_user" => $users[$i]->id,
				"username" => $users[$i]->username,
				"avatar" => $users[$i]->avatar,
				"comment" => $pre_comments[$i]->comment,
				"reply" => $pre_comments[$i]->reply,
				"date" => $date[0],
			];
		}
		
		$data = (object)[
			"message" => $message,
			"comments" => $comments
		];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}


	public function comment_post(Request $request) {
		$id_post = $request->route("id_post");
		$user = Auth::user();
		$type = $request->input("type");
		$id_comment = $request->input("id_comment");
		$comment = $request->input("comment");

		$post = PostModel::find($id_post);

		if(empty($post)) {
			$message = "Такого поста не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		// Добавление комментария
		if($type == "add") {
			$post = new CommentModel;
			$post->id_post = $id_post;
			$post->id_user = $user->id;
			$post->comment = $comment;
			$post->type = "post";
			$post->save();

			$message = "Комментарий добавлен";
		}

		// Удаление комментария
		if($type == "delete") {
			$comment = CommentModel::find($id_comment);

			if(empty($comment)) {
				$message = "Такого комментария не существует";
				$data = (object)["message" => $message];
				return view("manga.errors.error", ["data" => $data]);
			}

			if ($comment->id_user != $user->id) {
				$message = "Этот комментарий не ваш";
				$data = (object)["message" => $message];
				return view("manga.errors.error", ["data" => $data]);
			} else {
				$comment->delete();
				$message = "Комментарий удалён";
			}
		}


		$data = (object)[
			"message" => $message,
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}