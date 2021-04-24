<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\DirectoryGenresModel;

class UpdateController extends Controller {

	public function manga_update_form(Request $request) {
		$id = $request->route("id");
		$manga = MangaModel::find($id);
		$genres = DirectoryGenresModel::all();
		$data = (object)[
			"manga" => $manga,
			"genres" => $genres
		];
		return view("manga.manga.manga_update", ["data" => $data]);
	}

	public function manga_update(Request $request) {
		$validator = Validator::make($request->all(), [
			"russian_name" => "required|string",
			// "english_name" => "string",
			// "original_name" => "string",
			"images" => "required",
			"volume" => "required|numeric",
			"description" => "required|string",
			"category" => "required|string",
			"release" => "required|string",
			"translation" => "required|string",
			"genres" => "required",
			"author" => "required|string",
			"year_of_issue" => "required",
			"translators" => "required|string"
		]);

		if($validator->fails()) {
			$error = $validator->errors();
			return response(json_encode($error), 422)
				->header("Content-Type", "application/json");
		}

		$id = $request->route("id");

		$manga = MangaModel::find($id);
		$manga->russian_name = $request->input("russian_name");
		$manga->english_name = $request->input("english_name");
		$manga->original_name = $request->input("original_name");
		$manga->images = $request->input("images");
		$manga->description = $request->input("description");
		$manga->category = $request->input("category");
		$manga->release = $request->input("release");
		$manga->volume = $request->input("volume");
		$manga->translation = $request->input("translation");
		$manga->genres = $request->input("genres");
		$manga->author = $request->input("author");
		$manga->year_of_issue = $request->input("year_of_issue");
		$manga->translators = $request->input("translators");
		$manga->background = $request->input("background");
		$manga->save();

		$message = "Информация обновлена";

		$data = (object) [
			"message" => $message
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
