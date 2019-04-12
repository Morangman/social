<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function sendComment(Request $request){
        if($request){
            $user_id = \Auth::user()->id;
            $post_id = $request->post_id;
            $text = $request->text;

            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->post_id = $post_id;
            $comment->text = $text;
            $comment->save();

            $comments = Comment::where('post_id', $post_id)->join('users', 'users.id', '=', 'comments.user_id')->get();
            
            return response()->json([
                'success' => true,
                'comments' => $comments
            ]);
        }
    }

    public function getPostComments(Request $request){
        if($request){
            $post_id = $request->post_id;

            $comments = Comment::where('post_id', $post_id)->join('users', 'users.id', '=', 'comments.user_id')->get();
            $post = Post::where('id', $post_id)->first();
            
            return response()->json([
                'success' => true,
                'comments' => $comments,
                'post' => $post
            ]);
        }
    }
}
