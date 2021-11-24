<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $published_date ="DESC";
        
        if ($request->has('sort')) {
            $published_date = $request->get('sort');            
        }
        $posts = Post::orderBy('published_date', $published_date)->paginate(5);

        return view('blogs.index', compact('posts','published_date'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userPosts(Request $request)
    {
        $published_date ="DESC";
        
        if ($request->has('sort')) {
            $published_date = $request->get('sort');            
        }
        $posts = Post::where('user_id', Auth::id())->orderBy('published_date', $published_date)->paginate(5);
        return view('blogs.list', compact('posts','published_date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try{
            $id = Auth::user()->id;
            $post = new Post;
            $post->user_id = $id;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->published_date = date('Y-m-d H:i:s');
            $post->save();
            return redirect()->route('post.create')->with('success', 'Post created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
