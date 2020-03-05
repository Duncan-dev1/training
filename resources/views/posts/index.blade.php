@extends('layouts.app')

@section('content')
<div>
  <h1>Posts<h1>
      @if (count($posts)>0) 
        @foreach($posts as $post)
         <div class ="well">
           <div class="row mt-2">
            <div class="container">
             <div class="col-md-6 col-sm-6">
             
            <img style ="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on{{$post->created_at}}</small>
              </div>
            </div>
            </div>
              </div>
        @endforeach
      @else
        <p>No posts found</p>
      @endif
        </div>
@endsection   
              
         
     
