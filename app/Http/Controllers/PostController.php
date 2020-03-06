<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('tag')){
            $posts=Tag::where('name',request('tag'))->firstOrFail()->posts;
        }else{
            $articles=Article::latest()->get();
        }
        $posts= Post::orderBy('created_at','desc')->get();
        return view('posts.index')->with('posts',$posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('posts.create'); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        //file uploads
        if($request->hasFile('cover_image')){
            //get file name by extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //GET THE filename
            $filename=pathinfo( $filenameWithExt,PATHINFO_FILENAME);
            //get ext alone
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //uploading the image

            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }
        //creating post
        $post= new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','post created');
    }

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post= Post::find($id);
        //check if user is correct
        if(auth()->user()->id !==$post->user_id){
        return redirect('/posts')->with('error','unauthorized');
        }
        return view('posts.edit')->with('post',$post);
        
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
        
        $this ->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);
         //file uploads
      if($request->hasFile('cover_image')){
        //get file name by extension
        $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
        //GET THE filename
        $filename=pathinfo( $filenameWithExt,PATHINFO_FILENAME);
        //get ext alone
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //uploading the image

        $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
    }
        
        $post= Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image=$fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','post Updated');
    }
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','unauthorized');
            }
            if($post->cover_image !='noimage.jpg'){
             Storage::delete('public/cover_images/'.$post->cover_image);
            }
        $post->delete();
        return redirect('/posts')->with('success','post Removed');
    }
}
