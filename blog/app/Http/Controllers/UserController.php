<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function get_users(){
        $users = User::orderBy('created_at','asc')->take(12)->get();
        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    public function update_image(Request $request){
        $user_id = \Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        if($request->get('prof_image'))
        {
           $image = $request->get('prof_image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('prof_image'))->save(public_path('images/').$name);
            $user->photo = 'images/'.$name;
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
}
