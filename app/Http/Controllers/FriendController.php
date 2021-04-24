<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\FriendModel;
use App\Models\RatingModel;
use App\Models\ChapterModel;
use App\Models\CommentModel;
use App\Models\BookmarksModel;

class FriendController extends Controller {


	public function friend(Request $request) {
		if(!Auth::check()) {
			$message = "Вы не авторизованы";
			$data = (object)["message" => $message];
			return response(json_encode($data), 401)
				->header("Content-Type", "application/json");
		}

		if($request->has("type")) {
			$id_user = Auth::id();
			$id_friend = $request->route("id_user");
			$type = $request->input("type");

			$message = "Ничего не произошло";

			if($type == "add") {
				
				$friend = FriendModel::where("id_first", $id_user)->where("id_second", $id_friend)->first();
				if(!empty($friend)) {
					$message = "Пользователь находится у вас в друзьях";
				} else {
					$friend = new FriendModel;
					$friend->id_first = $id_user;
					$friend->id_second = $id_friend;
					$friend->save();
					$message = "Пользователь добавлен в друзья";
				}
			}

			if($type == "delete") {
				if($request->has("re")) $friend = FriendModel::where("id_second", $id_user)->where("id_first", $id_friend)->first();
				else $friend = FriendModel::where("id_first", $id_user)->where("id_second", $id_friend)->first();
				
				if(!empty($friend)) {
					$friend = FriendModel::find($friend->id_friend);
					$friend->delete();
					$message = "Пользователь удалён из друзей";
				} else {
					$message = "Пользователь не находится у вас в друзьях";
				}
			}

			$data = (object)[ "message" => $message ];
			return response(json_encode($data), 200)
				->header("Content-Type", "application/json");

		} else {
			$message = "Не выбран тип действия";
			$data = (object)[ "message" => $message ];
			return view("manga.errors.error", ["data" => $data]);
		}
		

	}



}
