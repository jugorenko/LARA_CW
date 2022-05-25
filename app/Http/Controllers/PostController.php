<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
   public function index(){
    $posts = Post::get();
    return view('posts.index',
    [
        'posts' => $posts
    ]);

   }

   public function create()
   {
       return view('posts.create');

   }

   public function store(Request $request)
   {
       //dd($request);
       $requestData = $request->all();

       $post = Post::create([
           'title' => $requestData['title'],
           'body' => $requestData['body'],
           'author_name' => $requestData['author_name'],
       ]);

       $post->save();

      // return redirect()->back();
      return redirect()->route('posts.show', ['post' => $post]);
   }

   public function show(Post $post)
   {
       //$post = Post::findOrfail($id);
       //dd{$id};
       return view('posts.show', [
           'post' => $post,
       ]);
   }

   public function edit(Post $post)
   {
       return view('posts.edit', [
           'post' => $post,
       ]);
   }

   public function update(Request $request, Post $post)
   {
       $requestData = $request->all();

       $post->title = $requestData['title'];
       $post->body = $requestData['body'];
       $post->author_name = $requestData['author_name'];

       $post ->save();

       return redirect()->route('posts.show', ['post' => $post]);
   }

   public function destroy(Post $post)
   {
    $post->delete();
    return redirect()->route('posts.index');
   }

}
