<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\DirectoryTagsModel;
use App\Models\DirectoryGenresModel;

class DirectoryController extends Controller {

	public function directory_form(Request $request) {
		$genres = DirectoryGenresModel::all();
		$tags = DirectoryTagsModel::all();
		
		$data = (object)[
			"genres" => $genres,
			"tags" => $tags
		];

		return view("manga.forms.directory_form", ["data" => $data]);
	}

	public function directory_add(Request $request) {
		if($request->has("genre") && $request->input("genre") != "") {
			$genre = new DirectoryGenresModel;
			$genre->genre = $request->input("genre");
			$genre->save();

			$message = "Жанр добавлен";
		} else {
			$message = "Спровочник не был найден";
		}

		if($request->has("tag") && $request->input("tag") != "") {
			$tag = new DirectoryTagsModel;
			$tag->tag = $request->input("tag");
			$tag->save();

			$message = "Тег добавлен";
		} else {
			$message = "Спровочник не был найден";
		}

		$genres = DirectoryGenresModel::all();
		$tags = DirectoryTagsModel::all();
		$data = (object)[
			"message" => $message,
			"genres" => $genres,
			"tags" => $tags
		];
		return response(json_encode($data), 200)
				->header("Content-Type", "application/json");
	}

	public function directory_delete(Request $request) {
		// Удаление жанра
		if($request->has("id_genre") && $request->input("id_genre") != "null") {
			$id_genre = $request->input("id_genre");
			$genre = DirectoryGenresModel::find($id_genre);
			$genre->delete();
			$message = "Жанр удалён";
		} else {
			$message = "Спровочник не был найден";
		}

		// Удаление тега
		if($request->has("id_tag") && $request->input("id_tag") != "null") {
			$id_tag = $request->input("id_tag");
			$tag = DirectoryTagsModel::find($id_tag);
			$tag->delete();
			$message = "Тег удалён";
		} else {
			$message = "Спровочник не был найден";
		}

		$genres = DirectoryGenresModel::all();
		$tags = DirectoryTagsModel::all();
		$data = (object)[
			"message" => $message,
			"genres" => $genres,
			"tags" => $tags
		];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
