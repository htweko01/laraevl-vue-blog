<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index() {
        $posts = Post::where('active', 'true')->get();
        return $posts;
    }

    public function create(Request $request) {
        $post = $this->validatePost($request);
        $post['created_by'] = $request->user()->id;
        if($request->hasFile('image')) {
            $post['image'] = $this->storeImage($request->file('image'));
        }

        Post::create($post);

        return response([
            'message' => "Post Create Success",
        ], 200);
    }

    public function edit(Request $request, Post $post) {
        $data = $this->validatePost($request);
        $data['edited_by'] = $request->user()->id;
        if($request->hasFile('image')) {
            if($post->image) { 
                Storage::delete('public/images/posts/' . $post->image);
            }
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $post->update($data);

        return response([
            'message' => "Post Edit Success",
        ], 200);
    }
    
    public function delete(Post $post) {
        $post->delete();
        return response([
            'message' => "Delete Success",
        ], 200);
    }

    private function validatePost($request, $id = null) {
        return Validator::make($request->all(), 
        [
            'title' => 'required|min:3|unique:posts,title,' . $id,
            'slug' => 'required|unique:posts,slug,' . $id,
            'body' => 'required',           
        ], 
        [
            'title.required' => "Post Title is required.",
            'slug.required' => "Post Slug is required.",
            'body.required' => "Post Body is required.",
        ]
        )->validate();
    }

    // store post image
    private function storeImage($image , $action = 'create') {
        $imgName = uniqid() . '__' . $image->getClientOriginalName();
        $image->storeAs('public/images/posts', $imgName);
        return $imgName;
    }
}
