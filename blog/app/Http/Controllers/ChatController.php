<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use App\RoomUser;
use App\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    
    public function createRoom(Request $request){

        $friend_id = $request->user_id;
        $my_id = \Auth::user()->id;
        $user = User::where('id', $friend_id)->first();

        $room = new Room();
        $room->name = $user['name'];
        $saved_ok = $room->save();

        $room_user = new RoomUser;
        $room_user->room_id = $room->id;
        $room_user->user_id = $my_id;
        $room_user->save();

        $room_user = new RoomUser;
        $room_user->room_id = $room->id;
        $room_user->user_id = $friend_id;
        $room_user->save();
        
        if($saved_ok){
            return response()->json([
                'success' => true
            ]);
        }
    }

    public function getRooms(){
        $my_id = \Auth::user()->id;
        $room_user = RoomUser::select('room_id')->where('user_id', $my_id)->groupBy('room_id')->get();
        $room_ids = [];
        for ($i = 0; $i < count($room_user); $i++){
            $room_ids []= $room_user[$i]['room_id'];
        }

        $users_ids = RoomUser::select('user_id')->whereIn('room_id', $room_ids)->groupBy('user_id')->get();

        $latest_msgs = Message::select('text')->whereIn('room_id', $room_ids)->latest()->first();

        $rooms = User::select('name')->whereIn('id', $users_ids)->groupBy('name')->get();

        return response()->json([
            'success' => true,
            'rooms' => $room_user,
            'latest_msgs' => $latest_msgs
        ]);
    }

    public function sendMessage(Request $request){
        $my_id = \Auth::user()->id;
        $text = $request->text;
        $room_id = $request->room_id;

        $message = new Message();
        $message->text = $text;
        $message->user_id = $my_id;
        $message->room_id = $room_id;
        $message->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function getMessages(Request $request){

        $room_id = $request->room_id;
        $msgs = Message::where('room_id', $room_id)->get();

        return response()->json([
            'success' => true,
            'messages' => $msgs,
            'roomID' => $room_id
        ]);
    }
}
