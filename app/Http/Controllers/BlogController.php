<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class BlogController extends Controller
{
    public function create_post() {
        return view('blog.create');
    }
    public function blog_store(Request $request)
{
    // Validate the form data
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
    ]);

    // Create the new blog post and associate it with the logged-in user
    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->published = true; // Adjust as needed
    $post->user_id = auth()->user()->id; // Set the user_id
    $post->save();

    return redirect()->route('home');
}

public function show(Post $post)
{
    // Load the comments relationship along with the user relationship for comments
    $post->load('comments.user');

    return view('blog.show', compact('post'));
}

    public function post_comment(Request $request, Post $post) {
        $request->validate([
            'content' => 'required', // Add any other validation rules you need
        ]);
    
        $comment = new Comment;
        $comment->user_id = auth()->id(); // Assuming you're using authentication
        $comment->post_id = $post->id; // Use $post object to get the post ID
    
        // Set the name of the currently logged-in user
        $comment->name = Auth::user()->name;
    
        $comment->content = $request->input('content');
        $comment->save();
    
        return back()->with('success', 'Comment added successfully!');
    }  

}    
