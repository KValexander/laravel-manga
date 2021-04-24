<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\ChapterModel;
use App\Models\DirectoryGenresModel;

class ChapterUpdateController extends Controller {

	public function chapter_update_form(Request $request) {
		if($request->has("volume") || $request->has("chapter")) {
			$id = $request->route("id");
			$volume = $request->input("volume");
			$chapter = $request->input("chapter");

			$pre_chapter = ChapterModel::where("id_manga", $id)->orderBy("id_chapter", "DESC")->where("volume", $volume)->where("chapter", $chapter)->first();

			if(empty($pre_chapter)) {
				$message = "Такой главы не существует";
				$data = (object)[ "message" => $message ];
				return view("manga.errors.error", ["data" => $data]);
			}

			$manga = MangaModel::find($pre_chapter->id_manga);

			$data = (object)[
				"manga" => $manga,
				"chapter" => $pre_chapter
			];

			return view("manga.forms.chapter.chapter_update", ["data" => $data]);

		} else {
			$message = "Вы не выбрали главу";
			$data = (object)[ "message" => $message ];
			return view("manga.errors.error", ["data" => $data]);
		}
	}

	public function chapter_update(Request $request) {
		$id = $request->route("id");
		$volume = $request->input("volume");
		$chapter = $request->input("chapter");

		$pre_chapter = ChapterModel::where("id_manga", $id)->where("volume", $volume)->where("chapter", $chapter)->first();
		
		$upd_chapter = ChapterModel::find($pre_chapter->id_chapter);
		$upd_chapter->volume = $request->input("volume");
		$upd_chapter->chapter = $request->input("chapter");
		$upd_chapter->chapter_title = $request->input("chapter_title");
		$upd_chapter->images = $request->input("images");
		$upd_chapter->save();

		$message = "Глава обновлена";
		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
