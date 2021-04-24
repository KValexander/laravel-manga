<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\RatingModel;
use App\Models\ChapterModel;

class RatingController extends Controller {

	public function rating(Request $request) {
		if(!Auth::check()) {
			$message = "Вы не авторизованы";
			$data = (object)["message" => $message];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		if($request->has("score")) {
			$id_manga = $request->route("id");
			$id_user = Auth::id();

			$ratingrs = RatingModel::where("id_manga", $id_manga)->where("id_user", $id_user)->first();
			if(!empty($ratingrs)) {
				$message = "Вы уже поставили свою оценку";
			} else {
				$rating = new RatingModel();
				$rating->id_manga = $id_manga;
				$rating->id_user = $id_user;
				$rating->rating = $request->input("score");
				$rating->type = "manga";
				$rating->save();
				
				$message = "Спасибо за вашу оценку";
			}
		} else {
			$message = "Отсутствует оценка";
		}

		$data = (object)["message" => $message];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
