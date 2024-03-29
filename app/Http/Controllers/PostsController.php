<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        // $posts = Post::orderBy('title', 'asc')->get();
        /*For Pagination*/
        $posts = Post::orderBy('title', 'asc')->paginate(10);
        return view('posts.index')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Get just Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //File Name oto store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            //Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->cover_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'New Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return abort(401);
            // return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
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

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            //Get just Filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //File Name oto store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            //Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        //Create Post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Your Post Has Been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return abort(401);
            // return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        if ($post->cover_image != 'noimage.jpg') {
            // Delete Image
            Storage::delete('public/cover_images/' . $post->cover_image);
        }
        $post->delete();

        return redirect('/posts')->with('error', 'Your Post Has Beed Deleted');
    }
}
