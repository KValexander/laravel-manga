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
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;
use App\Models\DirectoryTagsModel;

class PostsController extends Controller {

	public function posts(Request $request) {
		$auth_user = Auth::user();

		$pre_news = PostModel::where("type", "news")->orderBy("created_at", "DESC")->get();
		$news = 0;
		if(!empty($pre_news)) {
			$news = array();
			for ($i=0; $i < count($pre_news); $i++) { // count($pre_news)
				$user = UsersModel::find($pre_news[$i]->id_user);
				$date = explode(" ", $pre_news[$i]->created_at);
				$news[] = (object)[
					"id_post" => $pre_news[$i]->id_post,
					"id_user" => $user->id,
					"username" => $user->username,
					"date" => $date[0],
					"image_preview" => $pre_news[$i]->image_preview,
					"post_title" => $pre_news[$i]->post_title,
					"post_announce" => $pre_news[$i]->post_announce,
				];
			}
		}

		$pre_posts = PostModel::where("type", "post")->orderBy("created_at", "DESC")->get();
		$posts = 0;
		if(!empty($pre_posts)) {
			$posts = array();
			for ($i=0; $i < count($pre_posts); $i++) { 
				$user = UsersModel::find($pre_posts[$i]->id_user);
				$date = explode(" ", $pre_posts[$i]->created_at);
				$posts[] = (object)[
					"id_post" => $pre_posts[$i]->id_post,
					"id_user" => $user->id,
					"username" => $user->username,
					"date" => $date[0],
					"image_preview" => $pre_posts[$i]->image_preview,
					"post_title" => $pre_posts[$i]->post_title,
					"post_announce" => $pre_posts[$i]->post_announce,
				];
			}
		}

		$tags = DirectoryTagsModel::orderBy("tag", "ASC")->get();

		$data = (object)[
			"user" => $auth_user,
			"news" => $news,
			"posts" => $posts,
			"tags" => $tags,
		];
		return view("manga.posts", ["data" => $data]);
	}

	public function post(Request $request) {
		$id_post = $request->route("id_post");
		$post = PostModel::find($id_post);

		if(empty($post)) {
			$message = "Такого поста не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = UsersModel::find($post->id_user);

		$data = (object)[
			"id_user" => Auth::id(),
			"user" => $user,
			"post" => $post,
			"friends" => false,
		];

		if(Auth::check()) {
			$friend = FriendModel::where("id_first", Auth::id())->where("id_second", $user->id)->first();
			if(!empty($friend)) $data->friends = true;
			else $data->friends = false;
		}

		$pre_comments = CommentModel::where("id_post", $id_post)->orderBy("id_comment", "ASC")->get();
		if(count($pre_comments) != 0) {
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
			$users = array();
			$data->comments = $comments;
		}

		return view("manga.posts.post", ["data" => $data]);
	}

	public function post_add_form(Request $request) {
		$user = Auth::user();
		$tags = DirectoryTagsModel::orderBy("tag", "ASC")->get();
		$data = (object)[
			"user" => $user,
			"tags" => $tags
		];
		return view("manga.posts.post_add", ["data" => $data]);
	}

	public function post_add(Request $request) {

		if($request->input("image_preview") != null) {
			$validator = Validator::make($request->all(), [
				"image_preview" => "required|string|regex:/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/",
				"post_title" => "required|string|min:4|max:30",
				"post_content" => "required|string|min:50",
			]);
		} else {
			$validator = Validator::make($request->all(), [
				"post_title" => "required|string|min:4|max:30",
				"post_content" => "required|string|min:50",
			]);
		}

		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		$id_user = Auth::id();
		$image_preview = $request->input("image_preview");
		$post_title = $request->input("post_title");
		$post_announce = mb_convert_encoding(substr($request->input("post_content"), 0, 255) ."...", "UTF-8", "UTF-8");
		$post_content = mb_convert_encoding($request->input("post_content"), "UTF-8", "UTF-8");
		$tags = $request->input("tags");

		$post = new PostModel;
		$post->id_user = $id_user;
		$post->image_preview = $image_preview;
		$post->post_title = $post_title;
		$post->post_announce = $post_announce;
		$post->post_content = $post_content;
		if($tags == null) $post->tags = "Отсутствуют";
		else $post->tags = $tags;

		if($request->has("type")) $post->type = $request->input("type");
		else $post->type = "post";

		$post->save();

		$message = "Пост создан";
		$data = (object)["message" => $message];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function post_update_form(Request $request) {
		$id_post = $request->route("id_post");
		$user = Auth::user();
		$post = PostModel::find($id_post);

		if(empty($post)) {
			$message = "Такого поста не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		if($user->id != $post->id_user) {
			$message = "Вы не являетесь автором данного поста";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$tags = DirectoryTagsModel::orderBy("tag", "ASC")->get();

		$data = (object)[
			"post" => $post,
			"user" => $user,
			"tags" => $tags
		];

		return view("manga.posts.post_update", ["data" => $data]);
	}

	public function post_update(Request $request) {

		if($request->input("image_preview") != null) {
			$validator = Validator::make($request->all(), [
				"image_preview" => "required|string|regex:/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/",
				"post_title" => "required|string|min:4|max:30",
				"post_content" => "required|string|min:50",
			]);
		} else {
			$validator = Validator::make($request->all(), [
				"post_title" => "required|string|min:4|max:30",
				"post_content" => "required|string|min:50",
			]);
		}

		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}


		$id_post = $request->route("id_post");
		$id_user = Auth::id();

		$post = PostModel::find($id_post);
		if(empty($post)) {
			$message = "Такого поста не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		if($id_user != $post->id_user) {
			$message = "Вы не являетесь автором данного поста";
		} else {
			$image_preview = $request->input("image_preview");
			$post_title = $request->input("post_title");
			$post_announce = mb_convert_encoding(substr($request->input("post_content"), 0, 255) ."...", "UTF-8", "UTF-8");
			$post_content = mb_convert_encoding($request->input("post_content"), "UTF-8", "UTF-8");
			$tags = $request->input("tags");

			$post->id_user = $id_user;
			$post->image_preview = $image_preview;
			$post->post_title = $post_title;
			$post->post_announce = $post_announce;
			$post->post_content = $post_content;
			$post->tags = $tags;

			if($request->has("type")) $post->type = $request->input("type");
			else $post->type = "post";

			$post->save();
			$message = "Пост обновлён";
		}

		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");

	}


	public function post_delete(Request $request) {
		$id_post = $request->route("id_post");
		$id_user = Auth::id();

		$post = PostModel::find($id_post);
		if(empty($post)) {
			$message = "Такого поста не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		if($id_user != $post->id_user) {
			$message = "Вы не являетесь автором данного поста";
		} else {

			$comments = CommentModel::where("id_post", $post->id_post)->get();
			if(!empty($comments)) {
				for ($i=0; $i < count($comments); $i++) { 
					$comment = CommentModel::find($comments[$i]->id_comment);
					$comment->delete();
				}
			}

			$post->delete();
			$message = "Пост удалён";
		}

		$data = (object)["message" => $message];
		return view("manga.errors.error", ["data" => $data]);

	}

}