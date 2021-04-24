<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\RatingModel;
use App\Models\ReviewModel;
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;

class MangaController extends Controller {

	public function manga(Request $request) {
		$id = $request->route("id");
		$manga = MangaModel::find($id);
		if(empty($manga)) {
			$message = "Такой манги нет";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$chapter = ChapterModel::where("id_manga", $id)->orderBy("id_chapter", "DESC")->first();
		$first = ChapterModel::where("id_manga", $id)->orderBy("chapter", "ASC")->first();
		$chapters = ChapterModel::where("id_manga", $id)->orderBy("id_chapter", "DESC")->get();

		$rating = RatingModel::where("id_manga", $id)->get();
		$average = 0;

		$count_planned = BookmarksModel::where("id_manga", $id)->where("type", "PLANED")->get()->count();
		$count_watching = BookmarksModel::where("id_manga", $id)->where("type", "WATCHING")->get()->count();
		$count_completed = BookmarksModel::where("id_manga", $id)->where("type", "COMPLETED")->get()->count();
		$count_favorite = BookmarksModel::where("id_manga", $id)->where("type", "FAVORITE")->get()->count();

		$data = (object)[
			"manga" => $manga,
			"id_user" => Auth::id(),
			"chapter" => $chapter,
			"chapters" => $chapters,
			"comments" => "0",
			"first" => $first,
			"rating" => $average,
			"bookmark" => false,
			"count_planned" => $count_planned,
			"count_watching" => $count_watching,
			"count_completed" => $count_completed,
			"count_favorite" => $count_favorite,
		];

		$pre_reviews = ReviewModel::where("id_manga", $id)->orderBy("created_at", "DESC")->get();
		if(count($pre_reviews) != 0) {
			$reviews = array();
			if(count($pre_reviews) > 5) $count = 5;
			else $count = count($pre_reviews);
			for ($i=0; $i < $count; $i++) { 
				$date = explode(" ", $pre_reviews[$i]->created_at);
				$manga = MangaModel::where("id_manga", $pre_reviews[$i]->id_manga)->first();
				$user = UsersModel::where("id", $pre_reviews[$i]->id_user)->first();
				$rate = RatingModel::where("id_manga", $manga->id_manga)->where("id_user", $user->id)->first();
				$reviews[] = (object)[
					"id_review" => $pre_reviews[$i]->id_review,
					"id_manga" => $manga->id_manga,
					"id_user" => $user->id,
					"manga_title" => $manga->russian_name,
					"review_title" => $pre_reviews[$i]->review_title,
					"username" => $user->username,
					"date" => $date[0],
					"rating" => $rate->rating,
				];
			}
			$data->reviews = $reviews;
		}

		$pre_comments = CommentModel::where("id_manga", $id)->orderBy("id_comment", "ASC")->get();
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

		if (Auth::check()) {
			$id_user = Auth::id();
			$bookmark = BookmarksModel::where("id_manga", $id)->where("id_user", $id_user)->first();
			if(!empty($bookmark)) {
				$data->bookmark = true;
				$data->id_bookmark = $bookmark->id_bookmarks;
				if($bookmark->chapter != null) {
					$data->bk = (object)[
						"volume" => $bookmark->volume,
						"chapter" => $bookmark->chapter,
						"page" => $bookmark->page,
					];
				}
			}
		}
		
		if(count($rating) > 0) {
			$data->rating_count = count($rating);
			$sum = 0;
			for ($i=0; $i < count($rating); $i++) { 
				$sum = $sum + $rating[$i]->rating;
			}
			$average = $sum / count($rating);
			$average = round($average, 2);
			$data->rating_fractional = $average;
			$average = round($average);
			$data->rating_integer = $average;
		}

		return view("manga.manga", ["data" => $data]);
	}

}
