<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

        // Tag::create([                 //or we can use new Tag
        //     'title' => $request->name
        // ]);
        $tag = new Tag();
        $tag->title = $request->title;
        $tag->save();
        session()->flash('success','Tag created successfully');
        return redirect(route('tags.index'));
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
    public function edit(Tag $Tag) //dynamic route model binding auto Tag_id find hunxa
    {
        return view('tags.create')->with('tag',$Tag); //shortcut
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $tag = Tag::find($id);
        $tag->title = $request->title;
        $tag->save();
        session()->flash('success','Tag updated successfully');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count()>0){
            session()->flash('error','This Tag has some post associated');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success','Tag is deleted successfully');
        return redirect(route('tags.index'));
    }
}
