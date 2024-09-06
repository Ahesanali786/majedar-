<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    public function index() {
        return response()->json(Post::all());
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function show($id) {
        $post = Post::find($id);
        if ($post) {
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return response()->json($post);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    public function destroy($id) {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted']);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
}
