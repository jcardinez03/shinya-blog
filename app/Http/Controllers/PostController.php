<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $all_posts = $this->post->latest()->get();
        return view('posts.index')->with('all_posts', $all_posts);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif'
        ]);

        
        $this->post->user_id = Auth::user()->id; 
        $this->post->body = $request->body;
        $this->post->title = $request->title;
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image)); 
        $this->post->save();

        return redirect()->route('index');
    }

    public function show($id)
    {
        $post = $this->post->findOrFail($id);

        return view('posts.show')->with('post',$post);
    }

    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if($post->user->id != Auth::user()->id){
            return back();
        }

        return view('posts.edit')->with('post',$post);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif'
        ]);

        $post = $this->post->findOrFail($id);
        $post->user_id = Auth::user()->id; 
        $post->body = $request->body;
        $post->title = $request->title;

        if($request->image){
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image)); 
            $post->save();
        }
        

        return redirect()->route('post.show', $id);
    }

    public function destroy($id)
    {
        $this->post->destroy($id);

        return back();
    }

}
