@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
    <div class="well">
        <ul class="list-group">   
            @foreach ($posts as $post)
            <li class="list-group-item">
                <a href="/posts/{{$post->id}}" style="text-decoration:none; color:black" ><h3>{{$post->title}}</h3>
                <small>Written on {{$post->created_at}}</small></a>
            </li>    
            @endforeach
        </ul>
    </div>
    {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection