<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\About;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function get_users(){
        $my_id = \Auth::user()->id;
        $users = User::orderBy('created_at','asc')->where('id', '!=', $my_id)->take(12)->get();
        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    public function get_all_users(){
        $my_id = \Auth::user()->id;
        $users = User::orderBy('created_at','asc')->where('id', '!=', $my_id)->get();
       // $check = Friends::where('user_id', $my_id)
        //->where('friend_id', $friend_id)
        //->first();
        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    public function get_user(Request $request){
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->get();
        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }

    public function get_user_info(Request $request){
        if (Auth::check()) {
            $user_id = \Auth::user()->id;
            $info = User::where('id',$user_id)->first();
            if(!$info){
                return response()->json([
                    'error' => 'server error'
                ]);
            }
            return response()->json([
                'error' => null,
                'success' => true,
                'info' => $info
            ]);
        } else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function update_profile_info(Request $request){
        if (Auth::check()) {
            $user_id = \Auth::user()->id;
            $user = User::where('id',$user_id)->first();
            if(!$user){
                return response()->json([
                    'error' => 'server error'
                ]);
            }

            if($request->input('name')){
                $user->name = $request->input('name');
            }

            if($request->input('phone')){
                $user->phone = $request->input('phone');
            }

            if($request->input('nick')){
                $user->nick = $request->input('nick');
            }

            if($request->input('info')){
                $user->info = $request->input('info');
            }

            if($request->input('password')){
                $pwd = Hash::make($request->input('password'));
                $user->password = $pwd;
            }

            $user->save();

            return response()->json([
                'error' => null,
                'success' => true
            ]);

        } else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function update_image(Request $request){
        $user_id = \Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        if($request->get('prof_image'))
        {
           $image = $request->get('prof_image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

           $path = public_path().'/images/' . $user_id;
           \File::makeDirectory($path, $mode = 0777, true, true);

           \Image::make($request->get('prof_image'))->save(public_path('images\\').$user_id.'\\'.$name);
            $user->photo = 'images/'.$user_id.'/'.$name;
            $user->save();

            return response()->json([
                'success' => true
            ]);
         }else{
            return response()->json([
                'success' => false
            ]);
         }
    }

    public function delete_image(Request $request){
        $user_id = \Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        if($user->photo != 'images/img.png'){
            $image = $user->photo;
            $img_name = str_replace("/", "\\", '/'.'\\'. $image);
            $result = public_path().$img_name;
            $file = fopen($result, "w");
            fclose($file);
            unlink(public_path().$img_name);

            $user->photo = 'images/img.png';
            $user->save();

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
