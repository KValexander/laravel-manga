<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\UsersModel;
use App\Models\MangaModel;
use App\Models\ChapterModel;

class AuthController extends Controller {

	public function register_form(Request $request) {
		return view("manga.forms.register");
	}

	public function login_form(Request $request) {
		return view("manga.forms.login");
	}

	public function register(Request $request) {
		if(Auth::check()) {
			$message = "Вы уже авторизованы";
			$data = (object)["message"=>$message];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}
		
		$validator = Validator::make($request->all(), [
			"login" => "required|unique:users,login|string|min:4|max:30",
			"password" => "required|string|min:6|max:30",
			"username" => "required|string|min:4|max:30|unique:users,username",
			"email" => "required|regex:/@/",
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			$data = (object)["message"=>$errors];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		$user = new UsersModel;
		$user->login = $request->input("login");
		$user->password = bcrypt($request->input("password"));
		$user->username = $request->input("username");
		$user->email = $request->input("email");
		// $user->access = $request->input("access");
		$user->access = "4";
		$user->online = 0;
		$user->save();

		$message = "Вы зарегистрировались";
		$data = (object)["message" => $message];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function login(Request $request) {
		if(Auth::check()) {
			$message = "Вы уже авторизованы";
			$data = (object)["message"=>$message];
			return response(json_encode($data), 422)
				->header("Content-Type", "application/json");
		}

		$login = $request->input("login");
		$password = $request->input("password");

		if(Auth::attempt(["login" => $login, "password" => $password], true)) {
			$message = "Вы авторизировались";
			$user = UsersModel::find(Auth::id());
			$user->online = 1;
			$user->save();
		} else {
			$message = "Ошибка логина или пароля";
			$data = (object)["message" => $message];
			return response()->json($message, 422);
		}

		$data = (object)["message" => $message];
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
