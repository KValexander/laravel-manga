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

class ModerationController extends Controller {

	public function moderation(Request $request) {
		$users = UsersModel::all();
		$data = (object)[
			"users" => $users
		];

		return view("manga.moderation", ["data" => $data]);

	}

}
