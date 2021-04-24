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
use App\Models\DirectoryTagsModel;

class ReviewController extends Controller {

	public function reviews(Request $request) {
		$pre_reviews = ReviewModel::orderBy("created_at", "DESC")->get();
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
		
		$data = (object)[
			"reviews" => $reviews
		];

		return view("manga.reviews", ["data" => $data]);
	}

	public function review_single(Request $request) {
		$id_review = $request->route("id_review");
		$review = ReviewModel::find($id_review);
		
		if(empty($review)) {
			$message = "Такой рецензии нет";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = UsersModel::find($review->id_user);
		$manga = MangaModel::find($review->id_manga);
		$rating = RatingModel::where("id_manga", $review->id_manga)->where("id_user", $user->id)->first();
		$date = explode(" ", $review->created_at);

		$data = (object)[
			"user" => $user,
			"manga" => $manga,
			"review" => $review,
			"rating" => $rating->rating,
			"date" => $date[0],
			"friends" => false,
		];

		if(Auth::check()) {
			$friend = FriendModel::where("id_first", Auth::id())->where("id_second", $user->id)->first();
			if(!empty($friend)) $data->friends = true;
			else $data->friends = false;
		}

		return view("manga.reviews.review", ["data" => $data]);

	}

	public function review_add_form(Request $request) {
		$manga = MangaModel::all();
		$user = Auth::user();

		$data = (object)[
			"manga" => $manga,
			"user" => $user,
		];
		return view("manga.reviews.review_add", ["data" => $data]);
	}

	public function review_getting_rating(Request $request) {
		
		if(!$request->has("id_manga")) {
			$message = "Манга не выбрана";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = Auth::user();
		$id_manga = $request->input("id_manga");

		$rating = RatingModel::where("id_manga", $id_manga)->where("id_user", $user->id)->first();
		if(empty($rating)) $rating = 0;
		else $rating = $rating->rating;

		$data = (object)["rating" => $rating];
		return response()->json($data, 200);
	}

	public function review_add(Request $request) {

		$validator = Validator::make($request->all(), [
			"id_manga" => "required|numeric",
			"review_title" => "required|string|min:4|max:80",
			"review_content" => "required|string|min:50|"
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response()->json($data, 422);
		}

		$id_manga = $request->input("id_manga");
		$user = Auth::user();
		$review_title = $request->input("review_title");
		$review_content = $request->input("review_content");

		$review_check = ReviewModel::where("id_user", $user->id)->where("id_manga", $id_manga)->first();
		if(!empty($review_check)) {
			$message = "Не более одной рецензии от пользователя на одно произведение";
			$data = (object)["message" => $message];
			return response()->json($data, 200);
		}

		$rating = RatingModel::where("id_user", $user->id)->where("id_manga", $id_manga)->first();
		if(empty($rating)) {
			$message = "Поставьте оценку манге перед тем, как писать рецензию";
			$data = (object)["message" => $message];
			return response()->json($data, 200);
		}


		$review = new ReviewModel;
		$review->id_manga = $id_manga;
		$review->id_user = $user->id;
		$review->review_title = $review_title;
		$review->review_content = $review_content;
		$review->save();

		$message = "Рецензия добавлена";
		$data = (object)["message" => $message];

		return response()->json($data, 200);
	}

	public function review_update_form(Request $request) {
		if(!$request->has("id_review")) {
			$message = "Рецензия не выбрана";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$id_review = $request->input("id_review");
		$review = ReviewModel::find($id_review);

		if(empty($review)) {
			$message = "Такой рецензии нет";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = Auth::user();
		$manga = MangaModel::find($review->id_manga);
		$rating = RatingModel::where("id_manga", $review->id_manga)->where("id_user", $user->id)->first();
		$date = explode(" ", $review->created_at);

		$data = (object)[
			"user" => $user,
			"review" => $review,
			"manga" => $manga,
			"rating" => $rating->rating,
			"date" => $date,
		];

		return view("manga.reviews.review_update", ["data" => $data]);
	}

	public function review_update(Request $request) {

		$validator = Validator::make($request->all(), [
			"id_review" => "required|numeric",
			"review_title" => "required|string|min:4|max:80",
			"review_content" => "required|string|min:50|"
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response()->json($data, 422);
		}

		$user = Auth::user();
		$id_review = $request->input("id_review");
		$review = ReviewModel::find($id_review);

		if(empty($review)) {
			$message = "Такой рецензии не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}
		
		if($user->id != $review->id_user) {
			$message = "Вы не являетесь автором этой рецензии";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$review->review_title = $request->input("review_title");
		$review->review_content = $request->input("review_content");
		$review->save();

		$message = "Рецензия обновлена";
		$data = (object)["message" => $message];

		return response()->json($data, 200);
	}

	public function review_delete(Request $request) {

		if(!$request->has("id_review")) {
			$message = "Рецензия не выбрана";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = Auth::user();
		$id_review = $request->input("id_review");
		$review = ReviewModel::find($id_review);

		if(empty($review)) {
			$message = "Такой рецензии не существует";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}
		
		if($user->id != $review->id_user) {
			$message = "Вы не являетесь автором этой рецензии";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$review->delete();
		
		$message = "Рецензия удалена";
		$data = (object)["message" => $message];
		return view("manga.errors.error", ["data" => $data]);

	}

}