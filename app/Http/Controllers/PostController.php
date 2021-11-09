<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    //constructor to use middleware for only create and store method
    public function __construct()
    {
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload the image to storage
        // $image = $request->image->store('posts');
        $image = $request->image->store('posts');
        //create the post
        /* by this method we should make fillable property
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image
        ]);
        */
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->image = $image;
        $post->category_id = $request->category_id;
        $post->save();
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        //flash the message
        session()->flash('success','New Post created successfully');
        //redirect the user
        return redirect(route('posts.index'));
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
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->only(['title','description','content','category_id','image']);
        if($request->hasFile('image')){
            //store to storage
            $image = $request->image->store('posts');
            //delete old image
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        session()->flash('success','Post updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Post = Post::withTrashed()->where('id',$id)->firstOrFail();//$Post = Post::withTrashed()->find($id);
        if ($Post->trashed()) {
            $Post->deleteImage();
            $Post->forceDelete();
            session()->flash('success','Post deleted successfully');
        }
        else{
            $Post->delete();
        }
        return redirect()->back();
    }

    /**
     * Display all trashed post
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$posts);
        // return view('posts.index',compact('posts'));
    }
    public function restorePost($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        session()->flash('success','Post has been restored successfully');
        return redirect()->back();
    }
}
