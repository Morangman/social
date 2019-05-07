<?php

namespace App\Http\Controllers;

use DB;
use App\Quotation;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use App\Comment;
use App\Friends;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $posts = Post::orderBy('created_at', 'desc')
            ->where('user_id',$user_id)
            ->get();

            return response()->json([
                'error' => null,
                'success' => true,
                'posts' => $posts
            ]);
        }

    }

    public function news(){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $posts = DB::table('friends')
            ->join('users', 'users.id', '=', 'friends.friend_id')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            // ->orderBy('posts.created_at', 'desc')
            ->where('friends.user_id', $user_id)
            ->whereIn('posts.is_visible', [0, 1])
            ->orderBy('posts.created_at', 'desc')
            ->get();

            return response()->json([
                'error' => null,
                'success' => true,
                'posts' => $posts
            ]);
        }
    }

    public function get_posts(Request $request){
            $user_id = $request->user_id;

            $posts = Post::orderBy('created_at', 'desc')
            ->where('user_id',$user_id)->get();

            return response()->json([
                'error' => null,
                'success' => true,
                'posts' => $posts
            ]);
    }

    public function get_post(Request $request){
        $post_id = $request->post_id;

        $post = Post::where('id',$post_id)->first();

        return response()->json([
            'error' => null,
            'success' => true,
            'post' => $post
        ]);
}

    public function hide_post(Request $request){
        $post_id = $request->postId;
        $post = Post::where('id',$post_id)->first();
        $post->is_visible = 2;
        $post->updated_at = Carbon::now();
        $post->save();
    }
    
    //импорт данных в таблицу с новыми параметрами
    public function update_info(int $id, Request $request){
        $post = Post::where('id',$id)->first();
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        if($request->hasFile('image')){
            $oldFile = $post->src;
            unlink(public_path().$oldFile);
            $file = $request->file('image');
            $file_name = md5_file($file).'.'.$file->getClientOriginalExtension();
            $file->move(public_path() . '/img', $file_name);
            $post->src = str_replace("\\", "/", '\img'.'\\'. $file_name);
        }
        //$post->category_id = $request->input('category');
        // $tags = $request->input('tags', []);
        // if (isset ($request->tags)){
        //     $post->tag()->sync($tags, true);
        // }else{
        //     $post->tag()->sync(array());
        // }
        $post->updated_at = Carbon::now();
        $post->save();
    }
    
    //добавление нового поста
    public function add_post(Request $request){
        $post = new Post();
        $post->title = $request->input('title');
        $post->user_id = \Auth::user()->id;
        $post->post_body = $request->input('text');
        $post->is_visible = $request->input('is_visible');

        if($request->get('image'))
        {
           $image = $request->get('image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('image'))->save(public_path('images/').$name);
            $post->src = 'images/'.$name;
        }

        $post->created_at = Carbon::now();
        $post->updated_at = Carbon::now();
        $post->save();
        
        // $tags = $request->input('tags', []);
        // if (isset ($request->tags)){
        //     $post->tag()->sync($tags, false);
        // }else{
        //     $post->tag()->sync(array());
        // }
        
        return response()->json([
            'success' => true
        ]);
    }
    
    //удаление поста
   public function destroy($id)
   {
        $post = Post::find($id);
        $user_id = \Auth::user()->id;
        if($post->user_id == $user_id){
            if($post->src){
                $image = $post->src;
                $img_name = str_replace("/", "\\", '/'.'\\'. $image);
                $result = public_path().$img_name;
                $file = fopen($result, "w");
                fclose($file);
                unlink(public_path().$img_name);
            }

            $post->delete();
        }

        $like = Like::where('post_id', $id);
        $like->delete();

        $comment = Comment::where('post_id', $id);
        $comment->delete();

        return response()->json([
            'success' => true
        ]);
   }
//ToDO: Невозможно удалить лайки/дизлайки
   public function postLikePost(Request $request)
   {
       $post_id = $request['postId'];
       $user_id = \Auth::user()->id;

       $like = Like::where('user_id',  $user_id)->first();

       if($like){
        $like->delete();
       }else{
        $like = new Like();
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->like = 1;
        $like->save();
       }

       $post = Post::find($post_id);
       if (!$post) {
            return json_encode([
                'status' => 'error',
                'msg' => 'Post not found'
            ]);
       }else{
        $post->likes_cnt = $like->sum('like');
        $post->save();
       }
   }
   
}
