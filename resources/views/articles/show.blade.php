@extends('users.layout')
@section('content')
<div class="container">
        <div class="well col-md-8 col-md-offset-2 " >
            <h4 class="center description" style="text-align:center">
                <strong>
                        {{ $article->title }}
                </strong>
            </h4>
            <hr/>
                    {{ $article->description}}
            <hr/>
                <p>Status: {{$article->status}}</p>
            <div class="pull-right">
                <p class="center">
                    <em>Created By:</em>
                </p>
                <p class="center">
                    <small>
                        {{ $article->user->name }}
                    </small>
                    <div class="pull-right">
                    <div class="pull-right"><small>Created:{{ $article->created_at }}</small>
                    </div>
                </p>
            </div>
        </div>
        <div class="recipe-actions">
            <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
        </div>
        
    </div>
@endsection