<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    // instatiate the Comment
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;  
    }

    public function store(Request $request, $post_id)
    {
        $request->validate([
            'comment' => 'required|max:150'
        ]);

        $this->comment->body = $request->comment; // What the comment is
        $this->comment->user_id = Auth::user()->id; // Who created the comment
        $this->comment->post_id = $post_id; //Where(post) the comment was created
        $this->comment->save();

        return back();
    }

    
    public function destroy($id)
    {
        $this->comment->destroy($id);

        return back();
    }
}
