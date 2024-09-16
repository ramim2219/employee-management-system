<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use ValidatesRequests; // Add this line

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.name as user_name')
                ->latest('posts.created_at')
                ->get();
        return view('posts.index', compact('posts'));
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        //dd(auth()->user()->id);
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->user()->id ,
        ]);

        return back()->with('success', 'Post created successfully.');
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function commentStore(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comment::create($input);
   
        return back()->with('success', 'Comment added successfully.');
    }
}
