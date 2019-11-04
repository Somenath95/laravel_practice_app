@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <div class="row d-flex justify-content-between">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger' ])}}
                {!!Form::close() !!}    

            </div>
        @endif
            
    @endif
    
@endsection