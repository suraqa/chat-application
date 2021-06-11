<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller {

    public function __construct() {
        return $this->middleware("auth");
    }

    public function conversation($userId) { // User to chat with
//        $senderMsgs = Message::where("sender_id" , Auth::id())->where("receiver_id", $userId)->orderBy("created_at")->get();
//        $receiverMsgs = Message::where("sender_id" , $userId)->where("receiver_id", Auth::id())->orderBy("created_at")->get();
        return view("conversation2", [
            "users" => User::where("id", "!=", Auth::id())->get(),
            "userToChat" => User::find($userId),
            "currentUser" => User::find(Auth::id()),
//            "senderMsgs" => $senderMsgs,
//            "receiverMsgs" => $receiverMsgs
        ]);
    }

    public function sendMessage(Request $request) {

        $message = new Message();
        $message["sender_id"] = $request["senderId"];
        $message["receiver_id"] = $request["receiverId"];
        $message["content"] = $request["message"];

        if($message->save()) {
            return $message;
        } else {
            return "Error";
        }
//
//
//
//        return $request;
    }

}
