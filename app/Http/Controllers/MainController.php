<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;

class MainController extends Controller {

	public function main_page(Request $request) {
		$manga = MangaModel::orderBy("id_manga", "DESC")->get();

		foreach ($manga as $key => $val) {
			$date = explode(" ", $val->created_at);
			$image = explode(",", $val->images);
			$object[] = (object)[
				"id_manga" => $val->id_manga,
				"russian_name" => $val->russian_name,
				"image" => $image[0],
				"date" => $date[0]
			];
		}

		$data = (object) [
			"manga" => $object
		];

		return view("manga.index", ["data" => $data]);

	}

}
