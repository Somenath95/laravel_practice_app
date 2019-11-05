@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
    <div class="well">
        <ul class="list-group">   
            @foreach ($posts as $post)
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <img src="/storage/cover_images/{{$post->cover_image}}" style="width:100%">
                </div>
                <div class="col-md-8 col-sm-8">
                    <li class="list-group-item">
                        <a href="/posts/{{$post->id}}" style="text-decoration:none; color:black" ><h3>{{$post->title}}</h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small></a>
                    </li>    
                </div>
            </div>
            @endforeach
        </ul>
    </div>
    {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection