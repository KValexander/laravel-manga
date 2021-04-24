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

use App\Models\DialogModel;
use App\Models\MessageModel;

class MessageController extends Controller {

	public function message(Request $request) {
		$user = Auth::user();
		$pre_dialogs = DialogModel::where("id_first", $user->id)->orWhere("id_second", $user->id)->get();
		$dialogs = array();
		if(count($pre_dialogs) != 0) {
			for ($i=0; $i < count($pre_dialogs); $i++) { 
				$first = UsersModel::find($pre_dialogs[$i]->id_first);
				$second = UsersModel::find($pre_dialogs[$i]->id_second);
				$message = MessageModel::where("id_message", $pre_dialogs[$i]->last_message_id)->first();
				$dialogs[$i] = (object)[
					"id_dialog" => $pre_dialogs[$i]->id_dialog,
					"id_first" => $first->id,
					"id_second" => $second->id,
					"first_username" => $first->username,
					"second_username" => $second->username,
				];
				if(empty($message)) $dialogs[$i]->last_message = 0;
				else $dialogs[$i]->last_message = $message->message;
			}
		}

		$data = (object)[
			"user" => $user,
			"dialogs" => $dialogs,
		];

		return view("manga.private.message", ["data" => $data]);
	}

	public function dialog(Request $request) {
		if(!$request->has("id_interlocutor")) {
			$message = "Вы не выбрали собеседника";
			$data = (object)["message" => $message];
			return view("manga.errors.error", ["data" => $data]);
		}

		$user = Auth::user();
		$id_interlocutor = $request->input("id_interlocutor");

		$dialog = DialogModel::where("id_first", $user->id)->orWhere("id_second", $id_interlocutor)->first();

		if($user->id == $id_interlocutor) {

			if(empty($dialog)) {
				$message = "Ещё не время";
				$data = (object)["message" => $message];
				return view("manga.errors.error", ["data" => $data]);
			}

			$dialog = DialogModel::find($dialog->id_dialog);
			$user_first = UsersModel::find($dialog->id_second);
			$user_second = UsersModel::find($dialog->id_first);
			$pre_messages = MessageModel::where("id_dialog", $dialog->id_dialog)->orderBy("id_message", "DESC")->get();
			$messages = array();
			if(count($pre_messages) != 0) {
				for ($i=0; $i < count($pre_messages); $i++) { 
					$sender = UsersModel::find($pre_messages[$i]->id_sender);
					$messages[] = (object)[
						"id_message" => $pre_messages[$i]->id_message,
						"id_sender" => $sender->id,
						"username" => $sender->username,
						"message" => $pre_messages[$i]->message,
					];
				}
			}

			$data = (object)[
				"user" => $user,
				"dialog" => $dialog,
				"user_first" => $user_first,
				"user_second" => $user_second,
				"messages" => $messages,
			];

			return view("manga.private.dialog", ["data" => $data]);
		}

		if(empty($dialog)) {
			$dialog = new DialogModel;
			$dialog->id_first = $user->id;
			$dialog->id_second = $id_interlocutor;
			$dialog->last_message_id = "0";
			$dialog->sender = "0";
			$dialog->first_delete = "0";
			$dialog->second_delete = "0";
			$dialog->unread = "0";
			$dialog->save();
		}

		$dialog = DialogModel::find($dialog->id_dialog);
		$user_first = UsersModel::find($user->id);
		$user_second = UsersModel::find($id_interlocutor);
		$pre_messages = MessageModel::where("id_dialog", $dialog->id_dialog)->orderBy("id_message", "DESC")->get();
		$messages = array();
		if(count($pre_messages) != 0) {
			for ($i=0; $i < count($pre_messages); $i++) { 
				$sender = UsersModel::find($pre_messages[$i]->id_sender);
				$messages[] = (object)[
					"id_message" => $pre_messages[$i]->id_message,
					"id_sender" => $sender->id,
					"username" => $sender->username,
					"message" => $pre_messages[$i]->message,
				];
			}
		}

		$data = (object)[
			"user" => $user,
			"dialog" => $dialog,
			"user_first" => $user_first,
			"user_second" => $user_second,
			"messages" => $messages,
		];

		return view("manga.private.dialog", ["data" => $data]);
	}

	public function message_send(Request $request) {
		$id_dialog = $request->input("id_dialog");
		$id_sender = $request->input("id_sender");
		$id_addressee = $request->input("id_addressee");
		$re_message = $request->input("message");

		$message = MessageModel::create([
			"id_dialog" => $id_dialog,
			"id_sender" => $id_sender,
			"id_addressee" => $id_addressee,
			"message" => $re_message,
			"readed" => 0,
			"sender_delete" => 0,
			"addressee_delete" => 0,
		]);

		$dialog = DialogModel::find($id_dialog);
		$dialog->last_message_id = $message->id_message;
		$dialog->save();
	}

	public function message_delete(Request $request) {
		$id_message = $request->input("id_message");
		$message = MessageModel::find($id_message);
		$user = Auth::user();

		if($message->id_sender != $user->id) {
			$message = "Это не ваше сообщение";
			$data = (object)["message" => $message];
			return response()->json($data, 422);
		}

		$message->delete();
		$message = "Сообщение удалено";
		$data = (object)["message" => $message];
		return response()->json($data, 200);
	}

}
