<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
                     ->with('user')
                     ->get();
        
        return view('dashboard', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'nullable|boolean'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post-images', 'public');
        }
        Post::create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'is_visible' => $validated['is_visible'] ?? false
        ]);
        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }
        
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'nullable|boolean',
            'remove_image' => 'nullable|boolean'
        ]);

        if ($request->has('remove_image') && $post->image_path) {
            Storage::disk('public')->delete($post->image_path);
            $post->image_path = null;
        }

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $post->image_path = $request->file('image')->store('post-images', 'public');
        }

        $post->content = $validated['content'];
        $post->is_visible = $request->has('is_visible');
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
    public function toggleVisibility(Post $post)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }
        
        $post->is_visible = !$post->is_visible;
        $post->save();
        
        return back()->with('success', 'Post visibility updated!');
    }
}