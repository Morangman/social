<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use App\RoomUser;
use App\Message;
use App\Events\MessageSentEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadFile;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function createRoom(Request $request){

        $friend_id = $request->user_id;
        $my_id = \Auth::user()->id;
        $user = User::where('id', $friend_id)->first();
        $check = RoomUser::where('user_id', $friend_id)->where('user_id', '!=', $my_id)->get();

        if(count($check) == 0){
            $room = new Room();
            $room->name = $user['name'];
            $room->save();
    
            $room_user = new RoomUser;
            $room_user->room_id = $room->id;
            $room_user->user_id = $my_id;
            $room_user->save();
    
            $room_user = new RoomUser;
            $room_user->room_id = $room->id;
            $room_user->user_id = $friend_id;
            $room_user->save();
        }

        return response()->json([
            'success' => true,
            'test' => count($check)
        ]);
        
    }

    public function getRooms(){
        $my_id = \Auth::user()->id;
        $room_user = RoomUser::select('room_id')->where('user_id', $my_id)->groupBy('room_id')->get();
        $room_ids = [];
        for ($i = 0; $i < count($room_user); $i++){
            $room_ids []= $room_user[$i]['room_id'];
        }

        $latest_msgs = Message::select('text')->whereIn('room_id', $room_ids)->latest()->first();
        if(!$latest_msgs){
            $latest_msgs = '';
        }

        $users_ids = RoomUser::select('user_id')->whereIn('room_id', $room_ids)->groupBy('user_id')->get();
        $rooms = User::select('name')->whereIn('id', $users_ids)->groupBy('name')->get();

        $all = RoomUser::whereIn('room_id', $room_ids)
        ->where('user_id', '!=', $my_id)
        ->join('users', 'users.id', '=', 'room_users.user_id')
        ->select('room_id', 'name')
        ->get();

        return response()->json([
            'success' => true,
            'rooms' => $all
        ]);
    }

    public function sendMessage(Request $request){
        $my_id = \Auth::user()->id;
        $text = $request->text;
        $room_id = $request->room_id;

        $message = new Message();

        if($request->get('file'))
        {
            $file = $request->get('file');
            $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
            \Image::make($request->get('file'))->save(public_path('files/').$name, 60);
            $message->file = 'files/'.$name;
        }
        $message->text = $text;
        $message->user_id = $my_id;
        $message->room_id = $room_id;
        $message->save();

        $msgs = Message::where('room_id', $room_id)->get();

        broadcast(new MessageSentEvent($msgs))->toOthers();

        //\App\Events\MessageSentEvent::dispatch("ok");
        
         return response()->json([
            'success' => 'true',
            'messages' => $msgs
         ]);
    }

    public function getMessages(Request $request){

        $room_id = $request->room_id;
        $msgs = Message::where('room_id', $room_id)->get();

        return response()->json([
            'success' => true,
            'messages' => $msgs,
            'myId' => \Auth::user()->id
        ]);
    }

    public function searchRooms(Request $request){
        $my_id = \Auth::user()->id;
        $room_user = RoomUser::select('room_id')->where('user_id', $my_id)->groupBy('room_id')->get();
        $room_ids = [];
        for ($i = 0; $i < count($room_user); $i++){
            $room_ids []= $room_user[$i]['room_id'];
        }

        if($request->name == ""){
            $rooms = '';
        }else{
            $rooms = Room::whereIn('id', $room_ids)->groupBy('id')->where('name', 'like', '%' . $request->name . '%')->get();
        }

        return response()->json([
            'success' => true,
            'rooms' => $rooms
        ]);
    }
}
