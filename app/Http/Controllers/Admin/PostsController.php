<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Image;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,|max:4096',
            'additional_images' => 'array|max:3',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,|max:2048',
        ], $messages);

        $image = $request->file('image');
        $image_name = 'post_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save(public_path("images/$image_name"));
        $add_images = [];

        if($request->additional_images){
            foreach($request->additional_images as $add_image){
                $add_image_name = "post_".mt_rand(0, 100000).time().'.'.$add_image->getClientOriginalExtension();
                $add_images[] = $add_image_name;
                Image::make($add_image)->save(public_path("images/$add_image_name"));
            }
        }

        $new_post = new Post([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $image_name,
            'additional_images' => implode('-', $add_images)
        ]);

        $new_post->save();

        return redirect(route('admin.posts.create'))->with('success', 'Пост успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

         $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,|max:4096',
            'additional_images' => 'array',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,|max:2048'
        ], $messages);

        $post = Post::findOrFail($id);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = 'post_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save(public_path("images/$image_name"));
            $post->image = $image_name;
        }
        $add_images = [];
        
        if($request->additional_images){
            foreach($request->additional_images as $add_image){
                $add_image_name = "post_".mt_rand(0, 100000).time().'.'.$add_image->getClientOriginalExtension();
                $add_images[] = $add_image_name;
                Image::make($add_image)->save(public_path("images/$add_image_name"));
            }
            $post->additional_images = implode("-", $add_images);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect(route('admin.posts.edit', ['post' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $image = $post->image;
        File::delete(public_path("images/$image"));
        $add_images = explode('-', $post->additional_images);
        foreach($add_images as $add_image){
            File::delete(public_path("images/$add_image"));
        }
        $post->delete();
        return redirect(route('admin.posts.index'))->with('success', 'Пост успешно удален');        
    }
}
