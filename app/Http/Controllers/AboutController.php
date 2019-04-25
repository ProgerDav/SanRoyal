<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('about.index');
    }

    public function blog()
    {
        $posts = Post::all();
        return view('about.blog')->with('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $post_slug
     * @return \Illuminate\Http\Response
     */
    public function blog_show($post_slug)
    {
        $parts = explode('-', $post_slug);
        $id = array_shift($parts);
        $post_slug = implode('-', $parts);

        $post = Post::findOrFail($id);
        $related = Post::whereNot('id', $id)->take(3);

        if(Str::slug($post->title) !== $post_slug) return redirect()->route("about.blog_single", ['post_slug' => Str::slug($post->id.' '.$post->title)]);

        return view('about.blog_single')->with(['post' => $post, 'related' => $related]);
    }
}
