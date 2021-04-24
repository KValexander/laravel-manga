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

class UserController extends Controller {

	// Личная страница пользователя
	// ===============================================
	public function personal_area(Request $request) {

		$user = Auth::user();
		$pre_ratings = RatingModel::where("id_user", $user->id)->orderBy("created_at", "DESC")->get();
		$ratings_count = count($pre_ratings);
		$ratings = 0;
		if($ratings_count != 0) {
			$ratings = array();
			if($ratings_count > 5) $count = 5;
			else $count = $ratings_count;
			for ($i=0; $i < $count; $i++) { 
				$ratings_manga[] = MangaModel::where("id_manga", $pre_ratings[$i]->id_manga)->first();
				$ratings[] = (object)[
					"id_manga" => $ratings_manga[$i]->id_manga,
					"manga_name" => $ratings_manga[$i]->russian_name,
					"rating" => $pre_ratings[$i]->rating,
				];
			}
			$ratings_manga = array();
		}

		$pre_comments = CommentModel::where("id_user", $user->id)->where("type", "manga")->orderBy("created_at", "DESC")->get();
		$comments_count = count($pre_comments);
		$comments = 0;
		if($comments_count != 0) {
			$comments = array();
			if($comments_count > 3) $count = 3;
			else $count = $comments_count;
			for ($i=0; $i < $count; $i++) {
				$date = explode(" ", $pre_comments[$i]->created_at);
				$manga[] = MangaModel::where("id_manga", $pre_comments[$i]->id_manga)->orderBy("created_at", "DESC")->first();
				$comments[] = (object)[
					"id_comment" => $pre_comments[$i]->id_comment,
					"id_user" => $user->id,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"username" => $user->username,
					"comment" => $pre_comments[$i]->comment,
					"date" => $date[0],
				];
			}
			$manga = array();
		}

		$data = (object)[
			"user" => $user,
			"ratings" => $ratings,
			"ratings_count" => $ratings_count,
			"comments" => $comments,
			"comments_count" => $comments_count
		];

		return view("manga.private.personal_area", ["data" => $data]);
	}

	// Страница закладок
	// ===========================================
	public function bookmarks(Request $request) {

		$user = Auth::user();

		// Это всё определённо можно оптимизировать, так и проситься
		$pre_planed = BookmarksModel::where("id_user", $user->id)->where("type", "PLANED")->orderBy("created_at", "DESC")->get();
		$count_planed = count($pre_planed);
		$planed = 0;
		if($count_planed != 0) {
			$planed = array();
			for ($i=0; $i < $count_planed; $i++) { 
				$manga[] = MangaModel::where("id_manga", $pre_planed[$i]->id_manga)->first();
				$planed[] = (object)[
					"id_bookmark" => $pre_planed[$i]->id_bookmarks,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"manga_cover" => $manga[$i]->images,
				];
			}
			$manga = array();
		}

		$pre_watching = BookmarksModel::where("id_user", $user->id)->where("type", "WATCHING")->orderBy("created_at", "DESC")->get();
		$count_watching = count($pre_watching );
		$watching = 0;
		if($count_watching != 0) {
			$watching = array();
			for ($i=0; $i < $count_watching; $i++) { 
				$manga[] = MangaModel::where("id_manga", $pre_watching[$i]->id_manga)->first();
				$watching[] = (object)[
					"id_bookmark" => $pre_watching[$i]->id_bookmarks,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"manga_cover" => $manga[$i]->images,
					"volume" => $pre_watching[$i]->volume,
					"chapter" => $pre_watching[$i]->chapter,
					"page" => $pre_watching[$i]->page,
				];
			}
			$manga = array();
		}

		$pre_completed = BookmarksModel::where("id_user", $user->id)->where("type", "COMPLETED")->orderBy("created_at", "DESC")->get();
		$count_completed = count($pre_completed);
		$completed = 0;
		if($count_completed != 0) {
			$completed = array();
			for ($i=0; $i < $count_completed; $i++) { 
				$manga[] = MangaModel::where("id_manga", $pre_completed[$i]->id_manga)->first();
				$completed[] = (object)[
					"id_bookmark" => $pre_completed[$i]->id_bookmarks,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"manga_cover" => $manga[$i]->images,
				];
			}
			$manga = array();
		}

		$pre_favorite = BookmarksModel::where("id_user", $user->id)->where("type", "FAVORITE")->orderBy("created_at", "DESC")->get();
		$count_favorite = count($pre_favorite);
		$favorite = 0;
		if($count_favorite != 0) {
			$favorite = array();
			for ($i=0; $i < $count_favorite; $i++) { 
				$manga[] = MangaModel::where("id_manga", $pre_favorite[$i]->id_manga)->first();
				$favorite[] = (object)[
					"id_bookmark" => $pre_favorite[$i]->id_bookmarks,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"manga_cover" => $manga[$i]->images,
				];
			}
			$manga = array();
		}

		$data = (object)[
			"user" => $user,
			"planed" => $planed,
			"count_planed" => $count_planed,
			"watching" => $watching,
			"count_watching" => $count_watching,
			"completed" => $completed,
			"count_completed" => $count_completed,
			"favorite" => $favorite,
			"count_favorite" => $count_favorite,
		];

		return view("manga.private.bookmarks", ["data" => $data]);
	}

	// Страница друзей
	// ========================================
	public function friend(Request $request) {

		$user = Auth::user();

		$pre_friends = FriendModel::where("id_first", $user->id)->orderBy("created_at", "ASC")->get();
		$friends_count = count($pre_friends);
		if($friends_count != 0){
			for ($i=0; $i < $friends_count; $i++) { 
				$users[] = UsersModel::where("id", $pre_friends[$i]->id_second)->first();
				$friends[] = (object)[
					"id_user" => $users[$i]->id,
					"username" => $users[$i]->username,
				];
			}
			$users = array();
		} else {
			$friends = 0;
		}

		$pre_re_friends = FriendModel::where("id_second", $user->id)->orderBy("created_at", "ASC")->get();
		$re_friends_count = count($pre_re_friends);
		if($re_friends_count != 0){
			for ($i=0; $i < $re_friends_count; $i++) { 
				$users[] = UsersModel::where("id", $pre_re_friends[$i]->id_first)->first();
				$re_friends[] = (object)[
					"id_user" => $users[$i]->id,
					"username" => $users[$i]->username,
				];
			}
			$users = array();
		} else {
			$re_friends = 0;
		}

		$data = (object)[
			"user" => $user,
			"friends" => $friends,
			"friends_count" => $friends_count,
			"re_friends" => $re_friends,
			"re_friends_count" => $re_friends_count,
		];

		return view("manga.private.friend", ["data" => $data]);
	}

	// Страница постов
	// ======================================
	public function post(Request $request) {
		$user = Auth::user();
		$posts = PostModel::where("id_user", $user->id)->get();
		$posts_count = count($posts);

		$pre_comments = CommentModel::where("type", "post")->where("id_user", $user->id)->orderBy("created_at", "DESC")->get();
		$comments_count = count($pre_comments);
		$comments = 0;
		if($comments_count != 0) {
			$comments = array();
			if($comments_count > 3) $count = 3;
			else $count = $comments_count;
			for ($i=0; $i < $count; $i++) {
				$date = explode(" ", $pre_comments[$i]->created_at);
				$post = PostModel::where("type", "post")->where("id_post", $pre_comments[$i]->id_post)->first();
				$comments[] = (object)[
					"id_comment" => $pre_comments[$i]->id_comment,
					"id_user" => $user->id,
					"id_post" => $post->id_post,
					"post_title" => $post->post_title,
					"username" => $user->username,
					"comment" => $pre_comments[$i]->comment,
					"date" => $date[0],
				];
			}
			$post = array();
		}


		$data = (object)[
			"user" => $user,
			"posts" => $posts,
			"posts_count" => $posts_count,
			"comments" => $comments,
			"comments_count" => $comments_count
		];

		return view("manga.private.post", ["data" => $data]);
	}

	// Страница рецензий
	// ========================================
	public function review(Request $reqiest) {
		$user = Auth::user();

		$pre_reviews = ReviewModel::where("id_user", $user->id)->orderBy("created_at", "DESC")->get();
		$review_count = count($pre_reviews);
		$reviews = 0;
		if(count($pre_reviews) != 0) {
			$reviews = array();
			for ($i=0; $i < count($pre_reviews); $i++) { 
				$date = explode(" ", $pre_reviews[$i]->created_at);
				$manga = MangaModel::where("id_manga", $pre_reviews[$i]->id_manga)->first();
				$user = UsersModel::where("id", $pre_reviews[$i]->id_user)->first();
				$rating = RatingModel::where("id_manga", $manga->id_manga)->where("id_user", $user->id)->first();
				$reviews[] = (object)[
					"id_review" => $pre_reviews[$i]->id_review,
					"id_manga" => $manga->id_manga,
					"id_user" => $user->id,
					"manga_title" => $manga->russian_name,
					"review_title" => $pre_reviews[$i]->review_title,
					"username" => $user->username,
					"date" => $date[0],
					"rating" => $rating->rating,
				];
			}
		}

		$data = (object) [
			"user" => $user,
			"reviews" => $reviews,
			"review_count" => $review_count,
		];

		return view("manga.private.review", ["data" => $data]);
	}

	// Публичная страница пользователей
	// ======================================
	public function user(Request $request) {
		
		$id_user = $request->route("id_user");
		$user = UsersModel::find($id_user);

		if(empty($user)) {
			$message = "Такого пользователя нет";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$pre_ratings = RatingModel::where("id_user", $user->id)->orderBy("created_at", "DESC")->get();
		$ratings_count = count($pre_ratings);
		$ratings = 0;
		if($ratings_count != 0) {
			$ratings = array();
			if($ratings_count > 5) $count = 5;
			else $count = $ratings_count;
			for ($i=0; $i < $ratings_count; $i++) { 
				$ratings_manga[] = MangaModel::where("id_manga", $pre_ratings[$i]->id_manga)->first();
				$ratings[] = (object)[
					"id_manga" => $ratings_manga[$i]->id_manga,
					"manga_name" => $ratings_manga[$i]->russian_name,
					"rating" => $pre_ratings[$i]->rating,
				];
			}
			$ratings_manga = array();
		}

		$pre_comments = CommentModel::where("id_user", $user->id)->where("type", "manga")->orderBy("created_at", "DESC")->get();
		$comments_count = count($pre_comments);
		$comments = 0;
		if($comments_count != 0) {
			$comments = array();
			if($comments_count > 3) $count = 3;
			else $count = $comments_count;
			for ($i=0; $i < $count; $i++) { 
				$date = explode(" ", $pre_comments[$i]->created_at);
				$manga[] = MangaModel::where("id_manga", $pre_comments[$i]->id_manga)->orderBy("created_at", "DESC")->first();
				$comments[] = (object)[
					"id_user" => $user->id,
					"id_manga" => $manga[$i]->id_manga,
					"manga_name" => $manga[$i]->russian_name,
					"username" => $user->username,
					"comment" => $pre_comments[$i]->comment,
					"date" => $date[0],
				];
			}
			$manga = array();
		}
		
		$friend = FriendModel::where("id_first", Auth::id())->where("id_second", $id_user)->first();
		if(!empty($friend)) $friends = true;
		else $friends = false;

		$data = (object)[
			"user" => $user,
			"friends" => $friends,
			"ratings" => $ratings,
			"ratings_count" => $ratings_count,
			"comments" => $comments,
			"comments_count" => $comments_count,
		];

		return view("manga.private.user", ["data" => $data]);
	}

}
