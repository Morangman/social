<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function add_friend(Request $request){
        $friend_id = $request->friend_id;
        $user_id = \Auth::user()->id;

        $friends = new Friends();
        $friends->user_id = $user_id;
        $friends->friend_id = $friend_id;
        $friends->save();
        return response()->json([
            'error' => null,
            'success' => true
        ]);
    }

    public function delete_friend(Request $request){
        $friend_id = $request->friend_id;
        $user_id = \Auth::user()->id;

        Friends::where('user_id', $user_id)
            ->where('friend_id', $friend_id)
            ->delete();

        return response()->json([
            'error' => null,
            'success' => true
        ]);
    }

    public function get_all_friends(){
        $user_id = \Auth::user()->id;
        $friends = Friends::where('user_id', $user_id)
        ->join('users', 'users.id', '=', 'friends.friend_id')->take(12)->get();
        return response()->json([
            'error' => null,
            'success' => true,
            'friends' => $friends
        ]);
    }

    public function check_friend(Request $request){
        $friend_id = $request->friend_id;
        $user_id = \Auth::user()->id;

        $check = Friends::where('user_id', $user_id)
            ->where('friend_id', $friend_id)
            ->first();

        if($check){
            return response()->json([
                'success' => true,
                'check' => true
            ]);
        }else{
            return response()->json([
                'success' => true,
                'check' => false
            ]);
        }

    }
}
