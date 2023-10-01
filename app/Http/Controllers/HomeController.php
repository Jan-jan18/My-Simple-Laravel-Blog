<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home() {
        $posts = Post::where('published', true)->latest()->get();
        return view('home', compact('posts'));
    }
    
    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }



    public function store(Request $request)
    {
    // Validate the form data
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    // Create the new blog post
    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->published = true; // Adjust as needed
    $post->save();

    return redirect()->route('home');

    }

}
