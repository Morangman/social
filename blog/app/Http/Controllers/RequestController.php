<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function getdata(Request $request){
        if (Auth::check()) {
            $users = Auth::user();
            if(!$users){
                return response()->json([
                    'error' => 'server error'
                ]);
            }
            return response()->json([
                'error' => null,
                'success' => true,
                'user' => $users
            ]);
        } else{
            return response()->json([
                'success' => false
            ]);
        }
    }
}
