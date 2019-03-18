<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;
use Illuminate\Support\Facades\Auth;
use App\Post;

class FriendController extends Controller
{

    public function get_friend_posts(Request $request){
        $user_id = $request->user_id;
        $auth_user_id = \Auth::user()->id;

        $check = Friends::where('user_id', $auth_user_id)
            ->where('friend_id', $user_id)
            ->first();

        if($check){
            $posts = Post::orderBy('created_at', 'desc')
            ->where('user_id',$user_id)
            ->whereIn('is_visible', [0, 1])
            ->get();
        }else{
            $posts = Post::orderBy('created_at', 'desc')
            ->where('user_id',$user_id)
            ->where('is_visible', 0)
            ->get();
        }

        return response()->json([
            'error' => null,
            'success' => true,
            'posts' => $posts
        ]);
    }

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
        $count_friends = Friends::where('user_id', $user_id)
        ->join('users', 'users.id', '=', 'friends.friend_id')->count();
        $count_followers = Friends::where('friend_id', $user_id)->count();
        return response()->json([
            'error' => null,
            'success' => true,
            'friends' => $friends,
            'count' => $count_friends,
            'count_f' => $count_followers
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

    public function friend_friends(Request $request){
        $user_id = $request->friend_id;

        $friends = Friends::where('user_id', $user_id)
        ->join('users', 'users.id', '=', 'friends.friend_id')->take(12)->get();

        $count_friends = Friends::where('user_id', $user_id)
        ->join('users', 'users.id', '=', 'friends.friend_id')->count();
        
        $count_followers = Friends::where('friend_id', $user_id)->count();

        return response()->json([
            'error' => null,
            'success' => true,
            'friends' => $friends,
            'count' => $count_friends,
            'count_f' => $count_followers
        ]);
    }
}
