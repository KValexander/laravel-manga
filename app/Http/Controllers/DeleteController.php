<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\MangaModel;
use App\Models\RatingModel;
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;

class DeleteController extends Controller {

	public function manga_delete(Request $request) {
		$id = $request->route("id");

		$manga = MangaModel::find($id);

		if(!empty($manga)) {
			
			$ratings = RatingModel::where("id_manga", $id)->get();
			if(!empty($ratings)) {
				for ($i=0; $i < count($ratings); $i++) { 
					$rating = RatingModel::find($ratings[$i]->id_rating);
					$rating->delete();
				}
			}
			
			$bookmarks = BookmarksModel::where("id_manga", $id)->get();
			if(!empty($bookmarks)) {
				for ($i=0; $i < count($bookmarks); $i++) { 
					$bookmark = BookmarksModel::find($bookmarks[$i]->id_bookmarks);
					$bookmark->delete();
				}
			}

			$comments = CommentModel::where("id_manga", $id)->get();
			if(!empty($comments)) {
				for ($i=0; $i < count($comments); $i++) { 
					$comment = CommentModel::find($comments[$i]->id_comment);
					$comment->delete();
				}
			}

			$chapters  = ChapterModel::where("id_manga", $id)->get();
			if(!empty($chapters)) {
				for ($i=0; $i < count($chapters); $i++) { 
					$chapter = ChapterModel::find($chapters[$i]->id_chapter);
					$chapter->delete();
				}
			}

			$manga->delete();
			$message = "Манга успешно удалена";
		} else {
			$message = "Такой манги нет";
		}

		$data = (object)[
			"message" => $message
		];

		return view("manga.errors.error", ["data" => $data]);
	}

	public function chapter_delete(Request $request) {
		$id = $request->route("id");
		$volume = $request->route("volume");
		$chapter = $request->route("chapter");

		$ch = ChapterModel::where("volume", $volume)->where("chapter", $chapter)->first();
		$chapter = ChapterModel::find($ch->id_chapter);
		if(!empty($chapter)) {
			$chapter->delete();
			$message = "Глава успешно удалена";
		} else {
			$message = "Такой главы нет";
		}
		
		$data = (object)[
			"message" => $message
		];

		return view("manga.errors.error", ["data" => $data]);

	}

}
