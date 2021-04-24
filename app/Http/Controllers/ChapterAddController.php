<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\ChapterModel;
use App\Models\DirectoryGenresModel;

class ChapterAddController extends Controller {

	public function chapter_add_form(Request $request) {
		$id = $request->route("id");
		$manga = MangaModel::find($id);
		$chapters = ChapterModel::where("id_manga", $id)->orderBy("id_chapter", "DESC")->get();

		$data = (object)[
			"manga" => $manga,
			"chapters" => $chapters
		];
		return view("manga.forms.chapter.chapter_add", ["data" => $data]);
	}

	public function chapter_add(Request $request) {
		$id = $request->route("id");
		$manga = MangaModel::find($id);
		$validator = Validator::make($request->all(), [
			"volume" => "required|numeric",
			"chapter" => "required|numeric",
			"images" => "required"
		]);
		
		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message" => $errors];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		$chapter = ChapterModel::where("id_manga", $id)->where("volume", $request->input("volume"))->where("chapter", $request->input("chapter"))->first();
		if(!empty($chapter)) {
			$message = "Такая глава уже есть";
		} else {
			$chapter = new ChapterModel;
			$chapter->id_manga = $id;
			$chapter->volume = $request->input("volume");
			$chapter->chapter_title = $request->input("chapter_title");
			$chapter->chapter = $request->input("chapter");
			$chapter->images = $request->input("images");
			if(Auth::check()) $chapter->id_user = Auth::id();
			$chapter->save();
			$message = "Глава успешно добавлена";
		}

		$data = (object)[
			"message" => $message
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
