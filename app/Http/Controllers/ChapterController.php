<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\ChapterModel;
use App\Models\BookmarksModel;

class ChapterController extends Controller {

	public function chapter(Request $request) {
		$id = $request->route("id");
		$volume = $request->route("volume");
		$chapter = $request->route("chapter");

		$ch = ChapterModel::where("id_manga", $id)->where("volume", $volume)->where("chapter", $chapter)->first();
		if(empty($ch)) {
			$message = "К сожалению такой главы нет";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$manga = MangaModel::find($id);
		$chapters = ChapterModel::where("id_manga", $id)->orderBy("id_chapter", "DESC")->get();

		$data = (object)[
			"id_manga" => $manga->id_manga,
			"manga_name" => $manga->russian_name,
			"chapter_title" => $ch->chapter_title,
			"volume" => $ch->volume,
			"chapter" => $ch->chapter,
			"images" => $ch->images,
			"chapters" => $chapters,
			"manga" => $manga,
			"bookmark" => false,
		];

		if(Auth::check()) {
			$bookmark = BookmarksModel::where("id_manga", $manga->id_manga)->where("id_user", Auth::id())->first();
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

		return view("manga.chapter", ["data" => $data]);
	}

}
