<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\RatingModel;
use App\Models\ChapterModel;
use App\Models\BookmarksModel;

class BookmarksController extends Controller {

	public function bookmarks_add(Request $request) {

		$id_manga = $request->route("id");
		$id_user = Auth::id();
		$bookmarks = BookmarksModel::where("id_manga", $id_manga)->where("id_user", $id_user)->first();
		if(!empty($bookmarks)) {
			$message = "Уже у вас в закладках";
		} else {
			$bookmark = new BookmarksModel;
			$bookmark->id_manga = $id_manga;
			$bookmark->id_user = $id_user;
			$bookmark->type = "PLANED";
			$bookmark->save();
			$message = "Закладка добавлена";
		}
		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function bookmarks_update(Request $request) {

		if($request->has("type")) {
			$id_bookmark = $request->input("id_bookmark");
			$type = $request->input("type");

			$bookmark = BookmarksModel::find($id_bookmark);
			if($bookmark->type == $type) {
				$message = "Закладка уже находится в этой категории";
			} else {
				$bookmark->type = $type;
				
				if($type == "WATCHING") {
					$chapters = ChapterModel::where("id_manga", $request->route("id"))->get()->count();
					if($chapters == 0) {
						$message = "Главы отсутствуют";
						$data = (object)["message" => $message];
						return response(json_encode($data), 200)
							->header("Content-Type", "application/json");
					}
					$bookmark->volume = "1";
					$bookmark->chapter = "1";
					$bookmark->page = "0";
				} else {
					$bookmark->volume = null;
					$bookmark->chapter = null;
					$bookmark->page = null;
				}

				$bookmark->save();
				$message = "Закладка изменена";
			}

			$data = (object)["message" => $message];

			return response(json_encode($data), 200)
				->header("Content-Type", "application/json");
		} else {
			$message = "Не выбран тип";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}
	}

	public function bookmarks_watching(Request $request) {

		$id_bookmark = $request->input("id_bookmark");
		$id_manga = $request->route("id");
		$user = Auth::user();
		$type = $request->input("type");
		$volume = $request->input("volume");
		$chapter = $request->input("chapter");
		$page = $request->input("page");

		if($id_bookmark == "null") {
			$bk = BookmarksModel::where("id_manga", $id_manga)->where("id_user", $user->id)->first();
			if(!empty($bk)) {
				if($bk->chapter == $chapter) {
					$message = "Вы только что поставили закладку";
				} else {
					$bookmark = BookmarksModel::find($id_bookmark);
					$bookmark->type = $type;
					$bookmark->volume = $volume;
					$bookmark->chapter = $chapter;
					$bookmark->page = $page;
					$bookmark->save();
					$message = "Закладка обновлена";
				}
			} else {
				$bookmark = new BookmarksModel;
				$bookmark->id_manga = $id_manga;
				$bookmark->id_user = $user->id;
				$bookmark->type = $type;
				$bookmark->volume = $volume;
				$bookmark->chapter = $chapter;
				$bookmark->page = $page;
				$bookmark->save();
				$message = "Закладка добавлена";
			}
		} else {
			$bookmark = BookmarksModel::find($id_bookmark);
			$bookmark->type = $type;
			$bookmark->volume = $volume;
			$bookmark->chapter = $chapter;
			$bookmark->page = $page;
			$bookmark->save();
			$message = "Закладка обновлена";
		}

		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function bookmarks_delete(Request $request) {

		$id_manga = $request->route("id");
		$id_user = Auth::id();
		$pre_bookmark = BookmarksModel::where("id_manga", $id_manga)->where("id_user", $id_user)->first();
		if(!empty($pre_bookmark)) {
			$bookmark = BookmarksModel::find($pre_bookmark->id_bookmarks);
			$bookmark->delete();
			$message = "Закладка удалена";
		} else {
			$message = "Не находится у вас в закладках";
		}
		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");

	}

}
