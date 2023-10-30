<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class messagesController extends Controller
{
    function index(Request $request){

        $user_id = $request->user_id;
        $my_id = auth()->user()->id;

        $supplier = User::find($user_id);

        $messages = DB::table('messages')
            ->select("message" , "created_at" , "sender_id")
            ->whereRaw("(sender_id='".$user_id."' and receiver_id='".$my_id."') OR (sender_id='".$my_id."' and receiver_id='".$user_id."')")
            ->orderBy('id')
            ->get();

        if($messages->isNotEmpty()){
            foreach ($messages as $message){
                $message->created_at = jdate($message->created_at)->format("%A, %d %B %Y ,H:i");
                $message->class = ($message->sender_id==auth()->user()->id)?"chat-msg-right":"chat-msg-left";
            }
        }

        return ['supplier' => $supplier->name.' '.$supplier->last_name, "messages" => $messages ];

    }


    function create(Request $request){

        Message::create([
            "sender_id" => auth()->user()->id,
            "receiver_id" => $request->user_id,
            "message" => $request->message,
        ]);
    }
}
