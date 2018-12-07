<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
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
            ->where('user_id',$user_id)->get();

            return response()->json([
                'error' => null,
                'success' => true,
                'posts' => $posts
            ]);
        }

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
        $post->category_id = $request->input('category');
        $tags = $request->input('tags', []);
        if (isset ($request->tags)){
            $post->tag()->sync($tags, true);
        }else{
            $post->tag()->sync(array());
        }
        $post->updated_at = Carbon::now();
        $post->save();
        \Session::flash('save_post', 'Пост был успешно изменен!');
        return redirect ('/post');
    }
    
    //добавление нового поста
    public function add_post(Request $request){
        $post = new Post();
        $post->title = $request->input('title');
        $post->user_id = \Auth::user()->id;
        $post->text = $request->input('text');

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
        //     $post->tag()->sync($tags, true);
        // }else{
        //     $post->tag()->sync(array());
        // }
        
        // \Session::flash('save_message', 'Пост был успешно добавлен!');
        return response()->json([
            'success' => true
        ]);
    }
    
    //удаление поста
   public function destroy($id)
   {
        $post = Post::find($id);
        if($post->src){
            $image = $post->src;
            $img_name = str_replace("/", "\\", '/'.'\\'. $image);
            $result = public_path().$img_name;
            $file = fopen($result, "w");
            fclose($file);
            unlink(public_path().$img_name);
        }

        $post->delete();

        $like = Like::where('post_id', $id);
        $like->delete();

        return response()->json([
            'success' => true
        ]);
   }

   private function postLikeDislikePost(Request $request, bool $is_like)
   {
       $post_id = $request['postId'];
       $post = Post::find($post_id);
       if (!$post) {
               return json_encode([
                   'status' => 'error',
                   'msg' => 'Post not found'
               ]);
       }
       $user = \Auth::user();
       $like_record = $user->likes()
               ->where('post_id', $post_id)
               ->where('like', (($is_like)? 1:0))
               ->first();
       if ($like_record) {
           if(!$like_record->delete()){
               return json_encode([
                   'status' => 'error',
                   'msg' => 'Fail to delete'
               ]);
           } else {
               return json_encode([
                   'status' => 'ok',
                   'post_id' => $post_id,
                   'msg' => (($is_like)? "Лайк":"Дизлайк").' удален',
                   'likes' => $post->likes->sum('like'),
                   'dislikes' => $post->likes->where('like',0)->count()
               ]);
           }
       } else {
           $not_like = $user->likes()
                   ->where('post_id', $post_id)
                   ->where('like', (($is_like)? 0:1))
                   ->first();
           if ($not_like){
               $not_like->like = (($is_like)? 1:0);
               $not_like->update();
           } else {
               $new_like = new Like();
               $new_like->like = (($is_like)? 1:0);
               $new_like->user_id = $user->id;
               $new_like->post_id = $post->id;
               $new_like->save();

               //ToDO: не сохраняет лайки и дизы
                if($post){
                    $post->likes_cnt = $post->likes->sum('like');
                    $post->dislikes_cnt = $post->likes->where('like',0)->count();
                    $post->save();
                }
           }

           return json_encode([
               'status' => 'ok',
               'post_id' => $post_id,
               'msg' => (($is_like)? "Лайк":"Дизлайк").' учтен',
               'likes' => $post->likes->sum('like'),
               'dislikes' => $post->likes->where('like',0)->count()
           ]);
       } 

   }
   
   public function postLikePost(Request $request)
   {
       return $this->postLikeDislikePost($request, true);
   }

   public function postDislikePost(Request $request)
   {
       return $this->postLikeDislikePost($request, false);
   }
}
